<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MegagoodVibe;
use App\Models\MegagoodVibesComment;
use App\Models\MegagoodVibesLike;
use MsGraph;
use Response;

class MegagoodVibesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = MsGraph::contacts()->get();

        $megagoodVibes = MegagoodVibe::find($id);

        $megagoodVibesAll = MegagoodVibe::orderBy('created_at', 'DESC')
            ->get();
        $corporateOffice = $this->getCorporateOffice();
        $runningCredit = $this->getRunningCredit();
        
        return view('pages.megagoodVibes')
            ->withMegagoodVibes($megagoodVibes)
            ->withMegagoodVibesAll($megagoodVibesAll)
            ->withRunningCredit($runningCredit)
            ->withUser($user)
            ->withCorporateOffice($corporateOffice);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = MsGraph::contacts()->get();

        $megagoodVibeComments = new MegagoodVibesComment;

        $megagoodVibeComments->user = $user['contacts']['displayName'];
        $megagoodVibeComments->comment = $request->comment;
        $megagoodVibeComments->megagood_vibe_id = $request->megagood_vibe_id;

        $megagoodVibeComments->save();

        return Response::json($megagoodVibeComments);

    }

    public function likeMegagoodVibesContent(Request $request) 
    {
        $user = MsGraph::contacts()->get();

        $getMegagoodVibesLike = MegagoodVibesLike::where('megagood_vibe_id', $request->megagood_vibe_id)
            ->where('user', $user['contacts']['displayName'])
            ->get();

        if($getMegagoodVibesLike->isEmpty()){
            $megagoodVibesLikes = new MegagoodVibesLike;

            $megagoodVibesLikes->megagood_vibe_id = $request->megagood_vibe_id;
            $megagoodVibesLikes->user = $user['contacts']['displayName']; 
    
            $megagoodVibesLikes->save();
        } else {
            $megagoodVibesLikes = MegagoodVibesLike::where('megagood_vibe_id', $request->megagood_vibe_id)
                ->where('user', $user['contacts']['displayName'])
                ->delete();
        }

        return Response::json($megagoodVibesLikes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateMegagoodVibesComment(Request $request)
    {
        $megagoodVibesComment = MegagoodVibesComment::find($request->megagoodVibes_comment_id);

        $megagoodVibesComment->comment = $request->comment;

        $megagoodVibesComment->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $megagoodVibesComment = MegagoodVibesComment::find($request->megagoodVibes_comment_id)
            ->delete();

        return Response::json($megagoodVibesComment);
    }
}
