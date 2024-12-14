<?php

namespace App\Http\Controllers;

use App\Models\CorporateOffice;
use App\Models\RunningCredit;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getCorporateOffice() {
        
        $corporateOffice = CorporateOffice::orderBy('department', 'ASC')->get();

        return $corporateOffice;
    }

    public function getRunningCredit() {
        
        $runningCredit = RunningCredit::orderBy('created_at', 'DESC')
            ->first();

        return $runningCredit;
    }

}
