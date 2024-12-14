<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Megaproject;
use MsGraph;

class MegaprojectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $user = MsGraph::contacts()->get();
        $corporateOffice = $this->getCorporateOffice();
        $megaprojectsAll = Megaproject::all();        
        $runningCredit = $this->getRunningCredit();
        $megaprojects = Megaproject::find($id);

        return view('pages.megaprojects')
            ->withUser($user)
            ->withCorporateOffice($corporateOffice)
            ->withMegaprojects($megaprojects)            
            ->withRunningCredit($runningCredit)
            ->withMegaprojectsAll($megaprojectsAll);
    }

    public function megaprojectDetail($id)
    {
        $user = MsGraph::contacts()->get();
        $runningCredit = $this->getRunningCredit();
        $corporateOffice = $this->getCorporateOffice();
        $megaproject = Megaproject::find($id);
        
        return view('pages.megaprojectDetails')
            ->withRunningCredit($runningCredit)
            ->withCorporateOffice($corporateOffice)
            ->withMegaproject($megaproject)            
            ->withUser($user);
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
        //
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
