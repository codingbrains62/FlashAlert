<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Session;
use App\Http\Helpers\Helper;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserLoginMail;

class QuickReportController extends Controller
{
    public function QuickReportOption(){
     $data['QReportData'] = DB::table('reportoptions')->orderBy('QuickReportID','asc')->orderBy('Rank', 'desc')->get();
     return view('backend.quick_report', $data);
    }
    public function storeQReport(Request $request){
        $deleteTime = $request->DeleteTime;
        // Validate that DeleteTime contains a valid hour (0-23)
        // if (!preg_match('/^(0[0-9]|1[0-9]|2[0-3])$/', $deleteTime)) {
        //     return back()->with('failed', 'Invalid input for Delete Time. Please enter a valid hour (0-23).');
        // }
       $data = [
            'Rank' => $request->Rank,
            'QuickReportID' => $request->QuickReportID,
            'Note' => $request->Note,
            // 'DeleteTime' => $request->DeleteTime,
            //'DeleteTime' => date('h:i A', strtotime($request->DeleteTime)),
            'DeleteTime' => date('h:i A', strtotime($deleteTime)),
            //'OperatingStatus' => $request->OStatus,
            //'TStatus' => $request->TStatus,
        ];
        if ($request->hidden == '') {
        $addQReport = DB::table('reportoptions')->insert($data);
        $data = 'Created';
        }else {
            $addQReport = DB::table('reportoptions')->where('id', $request->hidden)->update($data);
            $data = "Updated";
        }
        if ($addQReport) {
            return redirect()->route('QReport')->with('success', "QReport $data Succesfully");
        } else {
            return back()->with('failed', 'Failed! Something Went Wrong!');
        }
    }
    public function editQReport(Request $request){
        $QROptionId = $request->QROptionId;
        $QReportData = DB::table('reportoptions')->where('id',$QROptionId)->get();
        // print_r($QReportData);
        // die;
        if(!empty($QReportData)){
        return $QReportData[0];
        }
   }
    public function increaseRank($id){
        DB::table('reportoptions')->where('id',$id)->increment('Rank');
        return redirect()->back();
    }
    public function decreaseRank($id){
        DB::table('reportoptions')->where('id',$id)->decrement('Rank');
        return redirect()->back();
    }
    public function deleteQR(Request $request){
        $confirmDelete = "Are you sure you want to delete this Quick Report data?";
        if ($confirmDelete) {
            $QRData = DB::table('reportoptions')->where('id', $request->QROptionId)->delete();
            return $QRData;
        }
    }
    public function usermanagement(){
     return view('backend.usermanagement');
    }

///////////add new user///////////////////////////
    public function addnewuser()
{  
    if (request()->has('forget_session')) {
        Session::forget('OrgCatID');
        Session::forget('Name');
        Session::forget('RegionID');
        Session::forget('UserName');
        Session::forget('PasswordHash');
        Session::forget('PrimaryName');
        Session::forget('PrimaryPhone');
        Session::forget('PrimaryWorkEmail');
        Session::forget('Address');
        Session::forget('City');
        Session::forget('State');
        Session::forget('Zipcode');
        Session::forget('UrlName');
        Session::forget('SecondaryName');
        Session::forget('HomePhone');
        Session::forget('SecondaryPhone');
        return redirect()->route('add.newuser');
    }
     Session::forget('OrgCatID');
     $data= DB::table('regions')->get();
     return view('backend.addnewuser',compact('data'));  
}

public function getnewuserregion(Request $request)
{
     if($request->getnewuserregion==''){
        $adduserregion=Session::get('RegionID');  
     }else{
        $adduserregion=$request->getnewuserregion;
     }
     $data1= DB::table('orgcats')->where('RegionID',$adduserregion)->get();
     return view('backend.addnewuserdetails',compact('adduserregion','data1'));  
}
public function showuserdata(Request $request){
    return view('backend.showuser');
}
public function addnewuserdata(Request $request){
    $request->validate([
                'OrgCatID' => 'required',
                'Name'=>'required',
                'UserName'=>'required|unique:users,UserName',
                'PasswordHash'=>'required|min:4|confirmed',
                'PasswordHash_confirmation'=>'required',
                'PrimaryName'=>'required',
                'PrimaryPhone' =>'required',
                'PrimaryWorkEmail'=>'required|email',
            ]);
    Session::put('Name', $request->Name);
    Session::put('RegionID', $request->RegionID);
    Session::put('OrgCatID', $request->OrgCatID);
    Session::put('UserName', $request->UserName);
    Session::put('PasswordHash', $request->PasswordHash);
    Session::put('PrimaryName', $request->PrimaryName);
    Session::put('PrimaryPhone', $request->PrimaryPhone);
    Session::put('PrimaryWorkEmail', $request->PrimaryWorkEmail);
    Session::put('Address', $request->Address);
    Session::put('City', $request->City);
    Session::put('State', $request->State);
    Session::put('Zipcode', $request->Zipcode);
    Session::put('UrlName', $request->UrlName);
    Session::put('SecondaryName', $request->SecondaryName);
    Session::put('HomePhone', $request->HomePhone);
    Session::put('SecondaryPhone', $request->SecondaryPhone);
    return view('backend.policy');
}
public function insertuserdata(Request $request){
    $OrgData =[
            'OrgCatID'=>Session::get('OrgCatID'),
            'RegionID'=>Session::get('RegionID'),
            'Name'=>Session::get('Name'),
        ];
        $lastInsertOrgs=DB::table('orgs')->insertGetId($OrgData); 
        //$decrypted = Crypt::encrypt(Session::get('PasswordHash'));
        $decrypted = Hash::make(Session::get('PasswordHash'));
        if(Session::get('UrlName')!=''){
            $urlname=Session::get('UrlName');
        }else{
            $urlname='flashalert.net/id/'.Session::get('Name'); 
        }
        $userData=[
            'OrgID'=>$lastInsertOrgs,
            'UserName'=>Session::get('UserName'),
            'PasswordHash'=>$decrypted,
            'PrimaryName'=>Session::get('PrimaryName'),
            'PrimaryPhone'=>Session::get('PrimaryPhone'),
            'PrimaryWorkEmail'=>Session::get('PrimaryWorkEmail'),
            'Address'=>Session::get('Address'),
            'City'=>Session::get('City'),
            'State'=>Session::get('State'),
            'Zipcode'=>Session::get('Zipcode'),
            'UrlName'=>$urlname,
            'SecondaryName'=>Session::get('SecondaryName'),
            'HomePhone'=>Session::get('HomePhone'),
            'SecondaryPhone'=>Session::get('SecondaryPhone'),
        ];
        $region = Helper::getDataID('regions',Session::get('RegionID'),'id');
        $result=DB::table('users')->insert($userData);
        if($result){
            Mail::to(Session::get('PrimaryWorkEmail'))->send(new UserLoginMail($region[0]->Description, Session::get('Name'),Session::get('UserName'),$urlname,Session::get('PrimaryWorkEmail'))); 
            return redirect()->route('signup.message')->with('success','User Added Succesfully');
        }else{
            return back()->with('failed', 'Something Went Wrong!');

        }
}

public function signupmessage(){
    return view('backend.signupmessage');
}


}