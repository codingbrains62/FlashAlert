<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Session;

class CommonController extends Controller
{
    //Under Construction Page
    public function underconst(){
        return view('frontend.underconst');
    }
    //About Page
    public function aboutus(){
        return view('frontend.about');
    }
   //Policy Page
    public function policy(){
        return view('frontend.policies');
    }
    //For guide for posting news page
    public function guideForPostingNews(){
        return view('backend.guide-for-postingNews');
    }
    //For for-news-media page
    public function forNewsMedia(){
        return view('frontend.fornewsmedia');
    }
    //For file-types page
    public function fileTypes(){
        return view('frontend.filetypes');
    }
    //For flashblog
    public function flashblog(){
        return view('frontend.flashblog');
    }
    //sampletext.html page
    public function sampletxt(){
        return view('frontend.sampletext');
    }
    //User login Page
    public function ulogin(){
        return view('frontend.ulogin');
    }
    // If your email address is in the FlashAlert system as an org contact, enter that email and an authentication link will be emailed to you.
    // Start through org contact Email Id
    public function emaillink(Request $request){
        $user = User::where('PrimaryWorkEmail', $request->emaillink)->first();
        if ($user) {
            $token = Str::random(60);   
            $user['remember_token'] = $token;
            $user->update();
            Mail::to($request->emaillink)->send(new MyMail($user->PrimaryName, $token)); 
            return back()->with('success_email', 'Success!  Login link has been sent to your email.');    
         }else{
            return back()->with('failed_email', 'Failed! email is not registered.');
         }
    }
    public function LoginLinkValidate(Request $request,$token){
        $user = User::where('remember_token', $token)->first();
        if ($user) {
                    $request->session()->put('loginId',$user->id);
                    $user['remember_token'] = null;
                    $user->update();
                    return redirect()->route('backend.dashboard')->with('success','Login Succesfull');
        }
        return redirect()->route('backend.signin')->with('failed_email', 'link has expired');
    }
// Start through org contact Email Id

    ///////////////////////////////////subscriber Dispatch status/////////////////////////
public function subsdispatch(){
    $user = DB::table('reports as r')
    ->join('orgs as o', 'r.OrgID', '=', 'o.id')
    ->join('reports_subdispatch as rd', 'r.id', '=', 'rd.ReportID')
    ->select('r.*', 'o.Name', 'rd.SendToSubs', 'rd.SendToPartners')
    ->limit(100)->orderBy('r.id','desc')
    ->get();
     $subscription=DB::table('publicusersubscription')->where('OrgID',$user[0]->OrgID)->limit(200)->get();
     $mtr = DB::table('Monitor')->get();
  return view('backend.subsdispatch',compact('user','subscription','mtr'));
   
}


//////////////Emergency Report Archive//////////////////////////////
public function emrreportarch(){
    $user = DB::table('reports')->orderBy('id','desc')->limit(11)
    ->get();
  return view('backend.emergencyreportarchive',compact('user'));
   
}
}
