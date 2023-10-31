<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringReportController extends Controller
{
    public function monitorReport(){
        return view('frontend.monitoringReport');
    }
}
