<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StarAppreciation;
use App\Models\Meganews;
use App\Models\SiglaNominee;
use App\Mail\StarAppreciationNotification;
use App\Mail\StarAppreciationSenderNotification;
use App\Mail\StarAppreciationGiverValidNotification;
use App\Mail\StarAppreciationReceiverValidNotification;
use App\Mail\StarAppreciationGiverNotValidNotification;
use App\Mail\StarAppreciationReceiverNotValidNotification;
use DB;
use Dcblogdev\MsGraph\Facades\MsGraph;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StarAppreciationController extends Controller
{
    /**
    * Display a listing of STAR appreciation entries.
    */
    public function index($date = '')
    {
        $user = MsGraph::get('me');

        $currentEmail = strtolower($user['mail'] ?? ($user['userPrincipalName'] ?? ''));
        $adminEmails = array_map('strtolower', config('star.admins', []));

        $corporateOffice = $this->getCorporateOffice();
        $runningCredit = $this->getRunningCredit();

        $meganews = Meganews::select('*', DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->orderBy('created_at', 'DESC')
            // ->take(5)
            ->where(function ($query) use ($date) {
                if($date) {
                    $query->where('created_at', 'LIKE', ''.$date.'%');   
                } else {
                    $query->where('created_at', 'LIKE', ''.date('Y-m').'%');
                }
            })
            ->get();

        if($meganews->isEmpty()) {
            $meganews = Meganews::select('*', DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->orderBy('created_at', 'DESC')
                ->take(5)
                ->get();
        }

        if (! in_array($currentEmail, $adminEmails, true)) {
            abort(403, 'Unauthorized');
        }

        $entries = StarAppreciation::orderBy('created_at', 'DESC')->get();

        return view('pages.star-entries', [
            'user' => $user,
            'entries' => $entries,
            'runningCredit' => $runningCredit,
            'meganews' => $meganews,
            'corporateOffice' => $corporateOffice,
        ]);
    }

    /**
     * Store a newly created STAR appreciation entry.
     */
    public function store(Request $request)
    {
        $user = MsGraph::get('me');

        $validated = $request->validate([
            'to_name'    => 'required|string|max:255',
            'thanks_for' => 'required|string|max:255',
            'situation_task'  => 'required|string',
            'action_results'  => 'required|string',
            'selected_values' => 'required|array|min:1',
            'selected_values.*' => 'required|string|distinct|in:Community,Malasakit,Excellence,Teamwork,Innovation,Integrity',
        ]);

        $selectedValues = array_values(array_unique($validated['selected_values'] ?? []));

        // Try to resolve the nominee's email from the SIGLA nominees list
        $nominee = SiglaNominee::where('name', $validated['to_name'])->first();
        $toEmail = $nominee->email ?? null;

        $entry = StarAppreciation::create([
            'to_name'    => $validated['to_name'],
            'to_email'   => $toEmail,
            'thanks_for' => $validated['thanks_for'],
            'situation_task' => $validated['situation_task'],
            'action_results' => $validated['action_results'],
            'selected_values' => $selectedValues,
            // keep legacy columns populated for backwards compatibility
            'situation'  => $validated['situation_task'],
            'task'       => $validated['situation_task'],
            'action'     => $validated['action_results'],
            'results'    => $validated['action_results'],
            'from_name'  => $user['displayName'] ?? '',
            'from_email' => $user['mail'] ?? ($user['userPrincipalName'] ?? null),
        ]);

        return response()->json([
            'success' => true,
            'entry'   => $entry,
        ]);
    }

    /**
     * Validate a STAR appreciation entry (admin only).
     */
    public function validateEntry(Request $request, $id)
    {
        $user = MsGraph::get('me');
        $currentEmail = strtolower($user['mail'] ?? ($user['userPrincipalName'] ?? ''));
        $adminEmails = array_map('strtolower', config('star.admins', []));

        if (!in_array($currentEmail, $adminEmails, true)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $entry = StarAppreciation::find($id);
        if (!$entry) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $validated = $request->validate([
            'status' => 'required|in:valid,not_valid',
        ]);

        if ($entry->validation_status !== null) {
            return response()->json(['error' => 'Already validated'], 422);
        }

        $status = $validated['status'];
        $entry->update([
            'validation_status' => $status,
            'validated_at'      => now(),
        ]);

        if ($status === 'valid') {
            $validThisMonth = StarAppreciation::where('from_email', $entry->from_email)
                ->where('validation_status', 'valid')
                ->whereYear('validated_at', now()->year)
                ->whereMonth('validated_at', now()->month)
                ->count();
            $remainingCommendations = max(0, 3 - $validThisMonth);

            if (!empty($entry->from_email)) {
                Mail::to($entry->from_email)
                    ->send(new StarAppreciationGiverValidNotification($entry, $remainingCommendations));
            }
            if (!empty($entry->to_email)) {
                Mail::to($entry->to_email)
                    ->send(new StarAppreciationReceiverValidNotification($entry));
            }
        } else {
            $monthlyCount = StarAppreciation::where('from_email', $entry->from_email)
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->count();

            if (!empty($entry->from_email)) {
                Mail::to($entry->from_email)
                    ->send(new StarAppreciationGiverNotValidNotification($entry, $monthlyCount));
            }
            if (!empty($entry->to_email)) {
                Mail::to($entry->to_email)
                    ->send(new StarAppreciationReceiverNotValidNotification($entry));
            }
        }

        return response()->json([
            'success'           => true,
            'validation_status' => $status,
        ]);
    }
}
