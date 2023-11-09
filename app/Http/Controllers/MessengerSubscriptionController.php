<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MessengerSubscriptionController extends Controller
{
    public function EmergencyMess($id)
        {      
                $data1=DB::table('users')->where('URLName',$id)->get();
                $data=DB::table('orgs')->where('id',$data1[0]->OrgID)->get();
                return view('frontend.emergencymess', compact('data','data1'));
        }
        
        public function EmergencyMess1($id)
        {      
                $data1=DB::table('users')->where('OrgID',$id)->get();
                $data=DB::table('orgs')->where('id',$data1[0]->OrgID)->get();
                $logo=DB::table('mediafile')->where('id', $data[0]->LogoMediaFileID)->get();  
                return view('frontend.emergencymess', compact('data','data1','logo'));
        }
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
            // $request->validate([
            //     'EmailAddress' => 'required|email|unique:publicuser,EmailAddress',
            // ]);
            $data=[
            'EmailAddress' => $request->EmailAddress,
            'OrgID' => $request->OrgID,
            'ResetCode' => 'abcdssdd', // 1 if checked, 0 if not
            'ResetDate' => '',
            'NPW' => 'test',
            'LastLogin' => '',
            'LastMailTest' => '',
            'DateCreated' => now(),
            'EmergSub' => $emergencyAlerts, // 1 if checked, 0 if not
            'NewsSub' => $newsReleases,
            ];
            //  $lastid=  DB::table('publicuser')->insertGetId($data);
            //  $id=['id'=>$lastid];
            //  $data['data'] = array_merge($data,$id);
            // dd( $data['data']);
        //    DB::table('publicusersubscription')->insert([
        //     'OrgID' =>$request->OrgID,
        //     'PublicUserID' =>$lastid,
        //     'EmergSub' => $emergencyAlerts, // 1 if checked, 0 if not
        //     'NewsSub' => $newsReleases, // 1 if checked, 0 if not
        // ]);
        // Redirect or return a response as needed
        // return redirect()->route('signup')->with(['success' => 'Subscription successful.', 'data' => $data]);
        return view('frontend.subSignup')->with('data', $data);
    }
            public function msmanage(Request $request)
        {
            // echo"<pre>";
            // print_r($request->all());
            // die;
            $decrypted = Hash::make($request->input('NPW'));
            //dd($decrypted);
            $data=[
                'EmailAddress' => $request->input('EmailAddress'),
                'ResetCode' => 'abcdssdd', // 1 if checked, 0 if not
                'ResetDate' => now(),
                'NPW' => $decrypted,
                'LastLogin' => now(),
                'LastMailTest' => now(),
                'DateCreated' => now(),
                ];
            try{
                $request->validate([
                    'EmailAddress' => 'required|email|unique:publicuser,EmailAddress',
                    'ConfirmEmailAddress' => 'required_with:EmailAddress|email|same:EmailAddress',
                    'NPW' => 'required|min:4',
                    'confirm_password' => 'required_with:NPW|same:NPW',
                ]);
                $lastid=  DB::table('publicuser')->insertGetId($data);
                $id=['id'=>$lastid];
                $data['data'] = array_merge($data,$id);

             DB::table('publicusersubscription')->insert([
            'OrgID' =>$request->OrgID,
            'PublicUserID' =>$lastid,
            'EmergSub' => $request->EmergSub, // 1 if checked, 0 if not
            'NewsSub' => $request->NewsSub, // 1 if checked, 0 if not
             ]);
                //dd($request->id );
            //     if ($request->id != '') {
            //        // dd($data);
            //         $user = DB::table('publicuser')->where('id',$request->id)->update($data);
            //         //dd($data);
            //    }
               $request->session()->put('ret',$lastid);
                    session(['ret' => $lastid]);
              return redirect()->route('sub-dashboard');
            }
            catch (\Illuminate\Validation\ValidationException $e) {
                $errors = $e->validator->errors();
                return back()->withErrors($errors)->withInput();
            }
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
                    $request->session()->put('ret', $user->id);
                    return redirect()->route('sub-dashboard');
                } else {
                    return back()->with('failed', 'Failed! Invalid password');
                }
            } else {
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
