<?php

namespace App\Http\Controllers;

use App\Models\CorporateOffice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MsGraph;
use File;

class CorporateOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = MsGraph::contacts()->get();
                $runningCredit = $this->getRunningCredit();

        $corporateOffice = $this->getCorporateOffice();
        $corporateOfficeData = CorporateOffice::find($id);

        return view('pages.corporateOffice')
            ->withUser($user)
            ->withRunningCredit($runningCredit)
            ->withCorporateOffice($corporateOffice)
            ->withCorporateOfficeData($corporateOfficeData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($file, $id)
    {
        $user = MsGraph::contacts()->get();
        $corporateOffice = $this->getCorporateOffice();
        $runningCredit = $this->getRunningCredit();

        $corporateOfficeData = CorporateOffice::find($id);
        if(File::exists(public_path('corporate_office_folder/'.$file.'/'.$id.'/'))) {
            $publicFiles = File::allFiles(public_path('corporate_office_folder/'.$file.'/'.$id.'/')); 
        } else {
            $publicFiles = '';
        }
        // dd($publicFiles);

        // dd($publicFiles);
        return view('pages.corporateOfficeFiles')
            ->withUser($user)
            ->withRunningCredit($runningCredit)
            ->withCorporateOffice($corporateOffice)
            ->withCorporateOfficeData($corporateOfficeData)
            ->withFile($file)
            ->withId($id)
            ->withPublicFiles($publicFiles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, $file, $id)
    {
        $fileName = $request->file('uploads');
        $name = $fileName->getClientOriginalName();
        $fileName->move(public_path('corporate_office_folder/'.$file.'/'.$id), $name);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CorporateOffice  $corporateOffice
     * @return \Illuminate\Http\Response
     */
    public function show(CorporateOffice $corporateOffice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CorporateOffice  $corporateOffice
     * @return \Illuminate\Http\Response
     */
    public function edit(CorporateOffice $corporateOffice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CorporateOffice  $corporateOffice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CorporateOffice $corporateOffice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CorporateOffice  $corporateOffice
     * @return \Illuminate\Http\Response
     */
    public function destroy(CorporateOffice $corporateOffice)
    {
        //
    }
}
