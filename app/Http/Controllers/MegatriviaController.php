<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Megatrivia;
use App\Models\MegatriviaAnswer;

use MsGraph;
use DB;
use Response;

class MegatriviaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = MsGraph::contacts()->get();
        $runningCredit = $this->getRunningCredit();
        $corporateOffice = $this->getCorporateOffice();
        $megatrivia = Megatrivia::orderBy('created_at', 'DESC')
            ->first();
        
        return view('pages.megatrivia')
            ->withMegatrivia($megatrivia)
            ->withRunningCredit($runningCredit)
            ->withUser($user)
            ->withCorporateOffice($corporateOffice);
    }

    public function allMegatrivia()
    {
        $user = MsGraph::contacts()->get();
        $corporateOffice = $this->getCorporateOffice();
        $runningCredit = $this->getRunningCredit();
        $megatrivia = Megatrivia::orderBy('created_at', 'DESC')
            ->get();

        return view('pages.allMegatrivia')
            ->withMegatrivia($megatrivia)
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

        $megatriviaAnswer = new MegatriviaAnswer;

        $megatriviaAnswer->answer = $request->answer;
        $megatriviaAnswer->megatrivia_id = $request->megatrivia_id;
        $megatriviaAnswer->user = $user['contacts']['displayName'];

        $megatriviaAnswer->save();

        $megatrivia = Megatrivia::find($request->megatrivia_id);

        if(strtolower($megatrivia->answer) == strtolower($request->answer)) {

            $getMegatriviaFirstCorrect = MegatriviaAnswer::whereRaw('LOWER(`answer`) LIKE "%'.strtolower($megatrivia->answer).'%"')
                ->orderBy('created_at', 'ASC')
                ->get();

            if($getMegatriviaFirstCorrect->isEmpty()) {
                $responseAnswer = 1;
            } else {
                $responseAnswer = 2;
            }
        } else {
            $responseAnswer = 0;
        }

        return Response::json($responseAnswer);

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
