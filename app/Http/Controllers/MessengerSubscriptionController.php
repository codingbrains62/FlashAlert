<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessengerSubscriptionController extends Controller
{
    public function loginme(){
        return view('frontend.messengerLogin');
    }
    public function lostpass(){
        return view('frontend.msg_forgetPass');
    }
    public function attach_app(){
        return view('frontend.attachAppTut');
    }
    public function frontend_region(){
        return view('frontend.regionsForMsgLogin');
    }
}
