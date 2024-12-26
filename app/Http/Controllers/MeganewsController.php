<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Meganews;
use App\Models\MeganewsComment;
use App\Models\MeganewsLike;
use Dcblogdev\MsGraph\Facades\MsGraph;
use Response;
use Str;
use DB;

class MeganewsController extends Controller
{
    public function index ($date = '') {
        $user = MsGraph::get('me');
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


        $meganewsGroups = Meganews::select('*', DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->orderBy('created_at', 'DESC')
            ->groupby('year','month')
            ->get();

        return view('pages.meganews')
            ->withUser($user)
            ->withRunningCredit($runningCredit)
            ->withMeganewsGroups($meganewsGroups)
            ->withMeganews($meganews)
            ->withCorporateOffice($corporateOffice);
    }

    public function view($id) {
        $user = MsGraph::get('me');
        $meganews = Meganews::select('*', DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->find($id);
        $corporateOffice = $this->getCorporateOffice();
        $runningCredit = $this->getRunningCredit();

        return view('pages.meganewsDetails')
            ->withMeganews($meganews)
            ->withUser($user)            
            ->withRunningCredit($runningCredit)
            ->withCorporateOffice($corporateOffice);
    }

    public function store(Request $request)
    {
        $user = MsGraph::get('me');

        $meganewsComments = new MeganewsComment;

        $meganewsComments->meganews_id = $request->meganews_id; 
        $meganewsComments->comment = $request->comment; 
        $meganewsComments->user = $user['displayName']; 

        $meganewsComments->save();
        

        return Response::json($meganewsComments);
    }

    public function likeMeganewsContent(Request $request)
    {
        $user = MsGraph::get('me');

        $getMeganewsLike = MeganewsLike::where('meganews_id', $request->meganews_id)
            ->where('user', $user['displayName'])
            ->get();

        if($getMeganewsLike->isEmpty()){
            $meganewsLikes = new MeganewsLike;

            $meganewsLikes->meganews_id = $request->meganews_id;
            $meganewsLikes->user = $user['displayName']; 
    
            $meganewsLikes->save();
        } else {
            $meganewsLikes = MeganewsLike::where('meganews_id', $request->meganews_id)
                ->where('user', $user['displayName'])
                ->delete();
        }

        return Response::json($meganewsLikes);

    }

    public function update(Request $request) 
    {
        $meganewsComment = MeganewsComment::find($request->meganews_comment_id);

        $meganewsComment->comment = $request->comment;

        $meganewsComment->save();

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $meganewsComment = MeganewsComment::find($request->meganews_comment_id)
            ->delete();

        return Response::json($meganewsComment);
    }
}
