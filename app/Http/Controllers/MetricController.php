<?php

namespace App\Http\Controllers;

use App\Models\Metric;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Response;
use Dcblogdev\MsGraph\Facades\MsGraph;

class MetricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $user = MsGraph::get('me');

        $metrics = new Metric;

        $metrics->action = $request->action;
        $metrics->url_name = $request->url_name;
        $metrics->action_val = $request->action_val;
        $metrics->user = $user['displayName'];

        $metrics->save();

        return Response::json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Metric  $metric
     * @return \Illuminate\Http\Response
     */
    public function show(Metric $metric)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Metric  $metric
     * @return \Illuminate\Http\Response
     */
    public function edit(Metric $metric)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Metric  $metric
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Metric $metric)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Metric  $metric
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metric $metric)
    {
        //
    }
}
