<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
    public function frontend_region(Request $request){
        $data['regionlist'] = DB::table('regions')->get();
        if ($request->has('search')) {
            $regionID = $request->input('RegionID');
            $organizationName = $request->input('organizationName');
            $data['orgName'] = $request->input('organizationName');
            // Construct the query for searching organizations based on the selected region and organization name
             $query = DB::table('orgs')
             ->join('regions', 'orgs.RegionID', '=', 'regions.id')// Add a join with the 'regions' table
             ->join('users', 'orgs.id', '=', 'users.OrgID') // Add a join with the 'users' table
             ->select('orgs.*', 'regions.Description as regionDescription', 'users.URLName as URLName');
            if ($regionID != 0) {
                $query->where('regions.id', $regionID);
            }
            if (!empty($organizationName)) {
                $query->where('orgs.Name', 'like', '%' . $organizationName . '%');
            }
        //Execute the query and fetch search results
         $data['searchResults'] = $query->get();
            // echo"<pre>";
            // print_r($data['searchResults']);
            // die;
        }
        return view('frontend.regionsForMsgLogin', $data);
    }

    public function subscribe(Request $request)
    {

          
            $emergencyAlerts = $request->has('EmergSub') ? 1 : 0;
            $newsReleases = $request->has('NewsSub') ? 1 : 0;
            $request->validate([
                'EmailAddress' => 'required|email',
            ]);
            $data=[
            'EmailAddress' => $request->input('EmailAddress'),
            'ResetCode' => 'abcdssdd', // 1 if checked, 0 if not
            'ResetDate' => '2023-10-10 11:55:55',
            'NPW' => 'test',
            'LastLogin' => '2023-10-10 11:55:55',
            'LastMailTest' => '2023-10-10 11:55:55',
            'DateCreated' => '2023-10-10',
            ];
             $lastid=  DB::table('publicuser')->insertGetId($data);
             $id=['id'=>$lastid];
             $data['data'] = array_merge($data,$id);
            // dd( $data['data']);
        
           
        DB::table('publicusersubscription')->insert([
            'OrgID' =>$request->OrgID,
            'PublicUserID' =>$lastid,
            'EmergSub' => $emergencyAlerts, // 1 if checked, 0 if not
            'NewsSub' => $newsReleases, // 1 if checked, 0 if not
        ]);
        // Redirect or return a response as needed
        // return redirect()->route('signup')->with(['success' => 'Subscription successful.', 'data' => $data]);
        return view('frontend.subSignup', $data);
    }
    public function msmanage(Request $request)
    {
        $decrypted = Hash::make($request->input('NPW'));
        //dd($decrypted);
        $data=[
            'EmailAddress' => $request->input('EmailAddress'),
            'ResetCode' => 'abcdssdd', // 1 if checked, 0 if not
            'ResetDate' => '2023-10-10 11:55:55',
            'NPW' => $decrypted,
            'LastLogin' => '2023-10-10 11:55:55',
            'LastMailTest' => '2023-10-10 11:55:55',
            'DateCreated' => '2023-10-10',
            ];
            
            try{
                $request->validate([
                    'ConfirmEmailAddress' => 'required_with:EmailAddress|email|same:EmailAddress',
                    'NPW' => 'required',
                    'confirm_password' => 'required_with:NPW|same:NPW',""
                ]);
                //dd($request->id );
                if ($request->id != '') {
                   // dd($data);
                    $user = DB::table('publicuser')->where('id',$request->id)->update($data);
                    //dd($data);
               }
            }
            catch (\Illuminate\Validation\ValidationException $e) {
                $errors = $e->validator->errors();
                return  back()->withErrors($errors)->withInput();
            }
            $request->session()->put('ret',$request->id);
                    session(['ret' => $request->id]);
            return redirect()->route('sub-dashboard');
            // return view('frontend.msmanage');
        }

        public function mesSubLogin(Request $request)
        {
            //dd($fail);
            $request->validate([
                'EmailAddress'=>'required|email',
                'NPW'=>'required',
            ]);
            $user = DB::table('publicuser')->where('EmailAddress', $request->EmailAddress)->first();
            // dd($request->NPW);
            if ($user) {
                if (Hash::check($request->NPW, $user->NPW)) {
                //if (Crypt::decrypt($user->PasswordHash) == $request->password) {
                    $request->session()->put('ret',$user->id);
                    session(['ret' => $user->id,]);
                    //  dd($user);
                        return redirect()->route('sub-dashboard');
                        //return view('frontend.msmanage');
                }else{
                    return back()->withErrors(['NPW' => 'Failed! Invalid password'])->withInput();
                }
            }else{
                return back()->with('failed', 'Failed! Invalid email');
            }
        }

        public function subdashboard()
    {    

        //echo Session::get('ret');
        if (Session::has('ret')) {
         $data=DB::table('publicuser')->where('id',session::get('ret'))->get(); 
        }
         
         return view('frontend.msmanage',compact('data'));
    }


}
