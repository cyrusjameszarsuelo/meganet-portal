<?php

namespace App\Http\Controllers;

use App\Models\OurBusinessesAndSubsidiary;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MsGraph;

class OurBusinessesAndSubsidiariesController extends Controller
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
        $ourBas = OurBusinessesAndSubsidiary::all();

        $corporateOffice = $this->getCorporateOffice();

        return view('pages.ourBAS')
            ->withUser($user)
            ->withRunningCredit($runningCredit)
            ->withCorporateOffice($corporateOffice)
            ->withOurBas($ourBas);
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
     * @param  \App\Models\OurBusinessesAndSubsidiary  $ourBusinessesAndSubsidiary
     * @return \Illuminate\Http\Response
     */
    public function show(OurBusinessesAndSubsidiary $ourBusinessesAndSubsidiary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OurBusinessesAndSubsidiary  $ourBusinessesAndSubsidiary
     * @return \Illuminate\Http\Response
     */
    public function edit(OurBusinessesAndSubsidiary $ourBusinessesAndSubsidiary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OurBusinessesAndSubsidiary  $ourBusinessesAndSubsidiary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OurBusinessesAndSubsidiary $ourBusinessesAndSubsidiary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OurBusinessesAndSubsidiary  $ourBusinessesAndSubsidiary
     * @return \Illuminate\Http\Response
     */
    public function destroy(OurBusinessesAndSubsidiary $ourBusinessesAndSubsidiary)
    {
        //
    }
}
