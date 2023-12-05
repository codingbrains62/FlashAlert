<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegister;
use App\Mail\SendTest;
use Carbon\Carbon;
class MessengerSubscriptionController extends Controller
{

   
    function crypt_email($Email) {
        define("ENCRYPT_STRING", "MonMar1Rotc1983");
        $Email = strtolower($Email);
        return md5($Email." ".ENCRYPT_STRING);
    }
    function random_validate_code2() {
        global $request;
        $seed = $request->ip() . rand() . 'padraummit';
        return sha1($seed, false);
    }
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
            $data1['regionlist'] = DB::table('regions')->get();
            if ($request->has('search')) {
                $regionID = $request->input('RegionID');
                $organizationName = $request->input('organizationName');
                $data1['orgName'] = $request->input('organizationName');
                $query = DB::table('orgs')
                ->join('regions', 'orgs.RegionID', '=', 'regions.id')
                ->join('users', 'orgs.id', '=', 'users.OrgID') 
                ->select('orgs.*', 'regions.Description as regionDescription', 'users.URLName as URLName');
                if ($regionID != 0) {
                    $query->where('regions.id', $regionID);
                }
                if (!empty($organizationName)) {
                    $query->where('orgs.Name', 'like', '%' . $organizationName . '%');
                }
            //Execute the query and fetch search results
            $data1['searchResults'] = $query->get();
                // echo"<pre>";
                // print_r($data['searchResults']);
                // die;
            }
            return view('frontend.regionsForMsgLogin', $data1);
        }
        public function subscribe(Request $request)
        {
            // Check if the email address already exists
            $existingUser =  DB::table('publicuser')->where('EmailAddress', $request->EmailAddress)->first();
           
            $errorMessage = null;
            //dd($request->all());
            $emergencyAlerts = $request->has('EmergSub') ? 1 : 0;
            $newsReleases = $request->has('NewsSub') ? 1 : 0;
            // dd($emergencyAlerts);
            $data = [
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
            if ($existingUser) {
                // Email address already exists, set error message
                $errorMessage = "This email address is already registered.";
                
            } 
            return view('frontend.subSignup')->with('data', $data)->with('errorMessage', $errorMessage);
        }
        
        
        public function msmanage(Request $request)
        {
            $plainPassword = $request->input('NPW');
            $decrypted = password_hash($plainPassword, PASSWORD_DEFAULT);
            $data=[
                'EmailAddress' => $request->input('EmailAddress'),
                'ResetCode' => 'abcdssdd',
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
                'EmergSub' => $request->EmergSub,
                'NewsSub' => $request->NewsSub,
                ]);
                // define("ENCRYPT_STRING", "MonMar1Rotc1983");
                // function crypt_email($Email) {
                //     $Email = strtolower($Email);
                //     return md5($Email." ".ENCRYPT_STRING);
                // }
                // function random_validate_code2() {
                //     global $request;
                //     $seed = $request->ip() . rand() . 'padraummit';
                //     return sha1($seed, false);
                // }
                $random_validate=$this->random_validate_code2();
                $email=$this->crypt_email($request->input('EmailAddress'));
                $length = 2;
                $letters = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                shuffle($letters);
                $validate = strtoupper(implode('', array_slice($letters, 0, $length)));
                DB::table('publicuseremail')->insert([
                    'PublicUserID' =>$lastid,
                    'UserEmailAddress' => $request->input('EmailAddress'), 
                    'CryptEmail' =>  $email,
                    'ValidateCode'=> $validate,
                    'ValidateCode2' =>$random_validate,
                    'CreateDate' => now(),
                    'ValidateTime' => now(),
                    'IsPrimary'=>1,
                    'CreatedIP' => $request->ip(),
                    ]);


                Mail::to($request->input('EmailAddress'))->send(new UserRegister($request->input('EmailAddress'), $validate));
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
                    $storedHashedPassword = $user->NPW;
                    $enteredPassword = $request->NPW;

                   if (password_verify($enteredPassword, $storedHashedPassword)) {
                    // if (Hash::check($request->NPW, $user->NPW)) {
                        //if (md5($request->NPW) === $user->NPW) {
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
                $data1=DB::table('publicuseremail')->where('PublicUserID',session::get('ret'))->get();  
                }
                return view('frontend.msmanage',compact('data','data1'));
            }

            public function logout()
            {
                if (Session::has('ret')) {
                    Session::pull('ret');
                }
                return redirect()->route('messengersub.login');
            }
            public function UserLoginLinkValidate(Request $request,$token,$email){
               $user = DB::table('publicuseremail')->where('UserEmailAddress',$email)->first();
                if ($user) {
                            $request->session()->put('ret',$user->PublicUserID);
                            $data=[
                                'Validated'=>1
                            ];
                            DB::table('publicuseremail')->where('UserEmailAddress',$email)->update($data);
                            return redirect()->route('sub-dashboard');
                }
                return back()->with('failed_email', 'link has expired');
            }
            public function validatecode(Request $request){
                $user = DB::table('publicuseremail')->where('id',$request->hidden)->first();
                //echo '<pre>';print_r($user); die;
                if($user->ValidateCode==$request->validatedcode){
                    $data=[
                        'Validated'=>1
                    ];
                    DB::table('publicuseremail')->where('id',$request->hidden)->update($data); 
                           
                }
                return redirect()->route('sub-dashboard');
             }

             public function adduseremail(Request $request){
                try{
                    $request->validate([
                        'email' => 'required|email',
                    ]);
                $random_validate=$this->random_validate_code2();
                $email=$this->crypt_email($request->input('email'));
                $length = 2;
                $letters = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                shuffle($letters);
                $validate = strtoupper(implode('', array_slice($letters, 0, $length)));
                DB::table('publicuseremail')->insert([
                    'PublicUserID' =>$request->userid,
                    'UserEmailAddress' => $request->input('email'), 
                    'CryptEmail' =>  $email,
                    'ValidateCode'=> $validate,
                    'ValidateCode2' =>$random_validate,
                    'CreateDate' => now(),
                    'ValidateTime' => now(),
                    'IsPrimary'=>0,
                    'CreatedIP' => $request->ip(),
                    ]);
                    Mail::to($request->input('email'))->send(new UserRegister($request->input('email'), $validate));
                    return redirect()->route('sub-dashboard');
                } catch (\Illuminate\Validation\ValidationException $e) {
                    $errors = $e->validator->errors();
                    return back()->withErrors($errors)->withInput();
                }
             }
        public function deleteemail($id){
            DB::table('publicuseremail')->where('id',$id)->delete();
            return redirect()->route('sub-dashboard');
        }
        

        public function resendcode($id)
        {

            
            $user = DB::table('publicuseremail')->where('id', $id)->first();
            
            $dateTimeFromDatabase = $user->CreateDate;
            $currenttime = Carbon::now();
            $timeDifferenceInMinutes = $currenttime->diffInMinutes($dateTimeFromDatabase);
            if ($timeDifferenceInMinutes > 2) {
                $length = 2;
                $letters = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                shuffle($letters);
                $validate = strtoupper(implode('', array_slice($letters, 0, $length)));
                DB::table('publicuseremail')->where('id', $id)->update(['CreateDate' => $currenttime,'ValidateCode'=> $validate]);
                Mail::to($user->UserEmailAddress)->send(new UserRegister($user->UserEmailAddress, $validate));
                return redirect()->route('sub-dashboard');
            }else{
                return back()->with('msg','You Can Resend Code After 2 Minutes');
            }
        }
        public function showorganization(Request $request){
            $id= $request->id;
            $response=DB::table('orgcats as oc')
            ->join('orgs as o', 'oc.id', '=', 'o.OrgCatID')
            ->where('oc.RegionID', $id)
            ->get(); 
            if(count($response)>0){
            $current_state = null;
            $html = '';
            foreach ($response as $datas){
            $state_name =  $datas->CatagoryName;
            if($state_name != $current_state) {
            $current_state = $state_name;
            $nameCount = $response->where('CatagoryName', $state_name)->count();
            $html .= '<optgroup label="'.$state_name.'('.$nameCount.')">';
            }
            $html.='<option value="'.$datas->id.'">'.$datas->Name.'</option>
            </optgroup>';
            }  
            echo $html; 
            }else{
                echo '';
            }                   
        }
        public function showorganizationbyserch(Request $request){
            $id= $request->id;
            $searchText=$request->searchvalue;
            // $response = DB::table('orgcats as oc')
            // ->join('orgs as o', 'oc.id', '=', 'o.OrgCatID')
            // ->where('oc.RegionID', $id)
            // ->where(function ($query) use ($searchText) {
            //     $query->where('o.Name', 'like', '%'.$searchText.'%');
            // })
            // ->get();


            $response = DB::table('orgcats as oc')
            ->join('orgs as o', 'oc.id', '=', 'o.OrgCatID');
            if (!empty($id)) {
                $response->where('oc.RegionID', $id);    
               
            }
            if (!empty($searchText)) {
                $response->where('o.Name', 'like', '%' . $searchText . '%');    
               
            }
            $html = '';
            $response= $response->get();
            if(count($response)>0){
                $current_state = null;
                
                foreach ($response as $datas){
                $state_name =  $datas->CatagoryName;
                if($state_name != $current_state) {
                $current_state = $state_name;
                $nameCount = $response->where('CatagoryName', $state_name)->count();
                $html .= '<optgroup label="'.$state_name.'('.$nameCount.')">';
                }
                $html.='<option value="'.$datas->id.'">'.$datas->Name.'</option>
                </optgroup><input type="hidden" id="optgroupid" value="'.$datas->id.'">';
                }  
                echo $html; 
                }else{
                    $html .= '<optgroup label="Opps">
                    <option value="">No Matches</option>';
                    echo $html;
                }        
        }
        // public function addsubscription(Request $request){
        //   //echo '<pre>'; print_r($request->all()); die;
        // $data=[
        //     'OrgID'=>$request->orgid,
        //     'PublicUserID'=>$request->userid,
        //     'EmergSub' => $request->Ealert,
        //     'NewsSub' => $request->Nrelease,
        // ];

        // DB::table('publicusersubscription')->insert($data);
        // return redirect()->route('sub-dashboard')->with('success','You Subscription Added SuccesfullY!');
        // } 


        public function addsubscription(Request $request)
        {
            try {
                $data = [
                    'OrgID' => $request->orgid,
                    'PublicUserID' => $request->userid,
                    'EmergSub' => $request->Ealert,
                    'NewsSub' => $request->Nrelease,
                ];

                DB::table('publicusersubscription')->insert($data);

                return redirect()->route('sub-dashboard')->with('success', 'Your Subscription Added Successfully!');
            } catch (\Illuminate\Database\QueryException $e) {
                if ($e->errorInfo[1] == 1062) {
                    return redirect()->route('sub-dashboard')->with('error', 'You Already Subscribe with this Organization.');
                }
                \Log::error($e);

                return redirect()->route('sub-dashboard')->with('error', 'An error occurred while processing your request.');
            }
        }

        
        
        // public function updatenewssubs(Request $request){
        //     echo '<pre>'; print_r($request->all()); die;
        //     $data=[
        //         'EmergSub' => $request->Ealertup,
        //         'NewsSub' => $request->Nreleaseup,
        //     ];

        //     DB::table('publicusersubscription')->where('id',$request->hidden)->update($data);
        //     return redirect()->route('sub-dashboard')->with('success','You Subscription Updated SuccesfullY!');
        // }
        public function updatenewssubs(Request $request){
            foreach ($request->all() as $key => $value) {
                if (Str::startsWith($key, ['Ealertup_', 'Nreleaseup_'])) {
                    $orgId = explode('_', $key)[1];
                    $data = [
                        'EmergSub' => $request->input("Ealertup_{$orgId}"),
                        'NewsSub' => $request->input("Nreleaseup_{$orgId}"),
                    ];
                    DB::table('publicusersubscription')->where('id', $orgId)->update($data);
                }
            }
            return redirect()->route('sub-dashboard')->with('success', 'Your Subscription Updated Successfully!');
        }
        
       
        
        
        public function deletesubscription($id){
            DB::table('publicusersubscription')->where('id',$id)->delete();
            return redirect()->route('sub-dashboard')->with('success','You Subscription Deleted SuccesfullY!');

        }
        public function changePasswrd(Request $request){
          //echo '<pre>'; print_r($request->all()); die;
          try{
            $request->validate([
                'newpassword' => 'required|min:8', 
                'confirm_new_password' => 'required|same:newpassword',
            ]);
              
            $plainPassword = $request->input('newpassword');
            $decrypted = password_hash($plainPassword, PASSWORD_DEFAULT);
            $data=[
                'NPW' => $decrypted,
            ];
            DB::table('publicuser')->where('id',$request->reset_pass_id)->update($data);
            return redirect()->route('sub-dashboard')->with('success','Password Changed Succesfully!');

          }catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            return back()->withErrors($errors)->withInput();
          }
        }
        public function deletesubscriptionaccount($id){
           // DB::table('publicuser')->where('id',$id)->delete();
            Session::pull('ret');
            return redirect()->route('messengersub.login')->with('success','Your Account Deleted SuccesfullY!');
        }
        public function sendtest($id){
           $user=DB::table('publicuseremail')->where('id',$id)->get();
           if($user[0]->Validated==1){
           Mail::to($user[0]->UserEmailAddress)->send(new SendTest());
           }
           return redirect()->route('sub-dashboard')->with('success','Send Test Succesfully!');

        }
}