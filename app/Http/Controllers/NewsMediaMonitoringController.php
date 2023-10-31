<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsMediaMonitoringController extends Controller
{
    //For News Media Monitor
    public function newsMediaMonitor(){
    return view('frontend.monitor');
}
}
