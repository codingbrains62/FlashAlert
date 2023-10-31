<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutoConfirEmailController extends Controller
{


    public function index(){
        echo 'hi';
    }
    public function profile(Request $request){
        //print_r($request->all());

    }
    public function AutoConfirmEmail()
    {
            return view('backend.Auto_confirm_email');
    }


    public function emailaddress(Request $request)
    {   
        $data='';
        $data1='';
        $data2='';
        $data3='';
        $data4='';
        $email='';
        if($request->email!=''){
           $email=$request->email;
           $data=DB::table('subemail')->where('Address',$request->email)->get(); 
           if(!empty($data) && count($data) > 0 ){
           $data1=DB::table('subs')->where('id',$data[0]->SubID )->get();
           }
           $data2 = DB::table('businesspartners')->where('EmailAddress', $request->email)->get();
           $userIDs = $data2->pluck('UserID')->toArray();
           $data3 = DB::table('users')->whereIn('id', $userIDs)->get();
           $orgIDs = $data3->pluck('OrgID')->toArray();
           $data4 = DB::table('orgs')->whereIn('id', $orgIDs)->get();
        }
        $EmergencyRecipient=DB::table('subemail')->where('EmergencyEmail',1)->get();
        $PressRecipient=DB::table('subemail')->where('EmergencyEmail',0)->get();
        $BussinessPartner=DB::table('businesspartners')->get();
        return view('backend.emailaddress',compact('EmergencyRecipient','PressRecipient','BussinessPartner','data','data1','data2','data3','data4','email'));
    }
}