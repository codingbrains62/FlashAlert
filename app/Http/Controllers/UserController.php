<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Orgcat;
use App\Models\Org;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Crypt;
use Validator;
use RateLimiter;
use App\Mail\MyMail;
use Illuminate\Support\Str;
class UserController extends Controller
{
    // Login Page
    public function login(){
        $key = "login.".request()->ip();
        return view('backend.signin',[
            'key'=>$key,
            'retries'=>RateLimiter::retriesLeft($key, 5),
            'seconds'=>RateLimiter::availableIn($key),
        ]);
    }
    public function customLogin(Request $request)
    {
        //dd ($request->orgID);
        $ip= $request->ip();
        $fail=[
            'username'=>$request->email,
            'password'=>$request->password,
            'address'=>$ip,
        ];
        //dd (session()->all());
        $request->validate([
            'email' => 'required',
            'password'=>'required|min:4|max:20'
        ]);
        $user = DB::table('users')->where('UserName', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->PasswordHash)) {

              

                // dd ($request->session()->regenerateToken());
            //if (Crypt::decrypt($user->PasswordHash) == $request->password) {
                $request->session()->put('loginId',$user->id);
                $request->session()->put('role',$user->SecurityLevel);
                session(['loginId' => $user->id, 'role' => $user->SecurityLevel]);
                RateLimiter::clear("login.".$request->ip());
                    return redirect()->route('backend.dashboard');
            }else{
            DB::table('failed_login')->insert($fail);
            return back()->with('failed', 'Failed! Invalid password');
            }
        }else{
            DB::table('failed_login')->insert($fail);
            return back()->with('failed', 'Failed! Invalid email');
        }
    }
    //Dashboard page
    public function admindashboard()
    {    
        if (Session::has('loginId')) {
         $data=DB::table('users')->where('id',session::get('loginId'))->get(); 
        }
        // echo"<pre>";
        // print_r($data);
        // die;
         
         return view('backend.dashboard',compact('data'));
    }
    // For user logout functionality
    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
        }
        return redirect()->route('backend.signin');
    }
    // For user logout functionality
    //for failed login details page
    public function failedlogin(){
        $user=DB::table('failed_login')->orderBy('id','desc')->paginate(25);
        return view('backend.failed_login',compact('user'));
    }
    public function delfailedlogin($id){
        $id=base64_decode($id);
        $data=['id'=>$id];
        $result=DB::table('failed_login')->delete($data);
        if($result){
        return back()->with('success',"Data Deleted Succesfully!");
        }else{
        return back()->with('failed',"Something Went Wrong!"); 
        }
    }
     public function deleteSelected(Request $request){
       $selectedIds = $request->input('selecteId');
        if (is_array($selectedIds) && count($selectedIds) > 0) {
        DB::table('failed_login')->whereIn('id', $selectedIds)->delete();
        }
         return redirect()->route('f.login')->with('success', "Selected items have been deleted.");
     }
    
    // for Login page Need Account Credentials?
    public function onetimelogin(){
        $user=DB::table('regions')->get();
        return view('backend.login-link', compact('user'));
    }
    // Get Regions/organization data
    public function getorgdata(Request $request){
        $id = $request->id;
        $userorg = Orgcat::where('RegionID', $id)->get();
        $output = '<label class="form-label">Organization Category:</label>';
        $output .= '<select class="form-select" aria-label="Default select example" style="width: 500px;" id="orgcategory">';
        $output .= '<option selected value="">Select your Organization</option>';
        foreach ($userorg as $emp) {
            $output .= '<option value="'. $emp->id .'">'. $emp->CatagoryName .'</option>';
        }
        $output .= '</select>';
        return $output;
    }
    // Get OrgCat Data
    public function orgcategory(Request $request){
        $id = $request->id;
        $userorg1 = Org::where('OrgCatID', $id)->get();
        $output = '<label class="form-label">Organization:</label>';
        $output .= '<select class="form-select" aria-label="Default select example" style="width: 500px;" id="getemail" name="getemail">';
        $output .= '<option selected value="">Select your Organization</option>';
        foreach ($userorg1 as $emp1) {
            $output .= '<option value="'. $emp1->id .'">'. $emp1->Name .'</option>';
        }
        $output .= '</select>';
        return $output;
    }
    // send mail for Account Credentials
    // public function sendlogindetail(Request $request){
    //     $id=$request->getemail;
    //     if($id==0){
    //      return back()->with('failed', ''); 
    //     }else{
    //      //$username2=DB::table('orglogin')->where('uid',$id)->get();
    //      $username2=DB::table('users')->where('id',$id)->get();
    //      if(!empty($username2)){
    //      $password=Crypt::decrypt($username2[0]->PasswordHash);
    //      Mail::to($username2[0]->PrimaryWorkEmail)->send(new MyTestMail($username2[0]->UserName, $password));
    //      return back()->with('success', '');
    //      }
    //     }
    //  }

    public function sendlogindetail(Request $request){
         $id=$request->getemail;
         $username2=DB::table('users')->where('OrgID',$id)->get();
         //echo '<pre>'; print_r($username2); die;
         if($username2->count() > 0){
            $token = Str::random(60);   
            $data=[
                'remember_token'=>$token
            ];
            DB::table('users')->where('OrgID',$id)->update($data);
            Mail::to($username2[0]->PrimaryWorkEmail)->send(new MyMail($username2[0]->PrimaryName, $token)); 
            return back()->with('success', '');    
         }else{
            return back()->with('failed', '');
         }
    }
  
      // ___________________________________Add user page ______________________________________________________________
     // Add user after login 
     // Add user page for get region data 
     public function addnewuser(){
     $data= DB::table('regions')->get();
     return view('backend.addnewuser',compact('data'));  
     }
     // Add user page for get org category data for selected region
     public function getnewuserregion(Request $request){
     $adduserregion=$request->getnewuserregion;
     $data1= DB::table('orgcats')->where('RegionID',$adduserregion)->get();
     return view('backend.addnewuserdetails',compact('adduserregion','data1'));  
     }
     public function addnewuserdata(Request $request){
     $validator = Validator::make($request->all(),[
        'OrgCatID' => 'required',
        'orgname'=>'required',
        'orgusername'=>'required|unique:users,UserName',
        'orguserpass'=>'required',
        'orguserpcontact'=>'required',
        'orguserpophone' =>'required',
        'orguseroemail'=>'required|email',
      ]);
        if ($validator->fails()) {
         if ($validator->fails('orgusername')) {
         $error_username = "This is already taken";
         }
        $adduserregion=$request->RegionID;
        $data1= DB::table('orgcats')->where('RegionID',$adduserregion)->get();
        return view('backend.addnewuserdetails',compact('adduserregion','data1','error_username'));
       }
       //$decrypted = Crypt::encrypt($request->orguserpass);
       $decrypted = Hash::make(Session::get('PasswordHash'));
        $addorg=[  
        'RegionID'=>$request->RegionID,
        'OrgCatID'=>$request->OrgCatID,
        'name'=>$request->orgname,
        ];
        $result= DB::table('orgs')->insertGetId($addorg);
        $data=[
        // 'OrgCatID'=>$request->OrgCatID,
        'OrgCatID'=>$result,
        'UserName'=>$request->orgusername,
        'PasswordHash'=>$decrypted,
        'Address'=>$request->orguseradd,
        'City'=>$request->orgcityname,
        'State'=>$request->orguserstate,
        'Zipcode'=>$request->orguserzip,
        'URL'=>$request->orguserurl,
        'PrimaryName'=>$request->orguserpcontact,
        'PrimaryPhone'=>$request->orguserpophone,
        'PrimaryWorkEmail'=>$request->orguseroemail,
        'SecondaryPhone'=>$request->orguserhpno,
        'SecondaryPhone'=>$request->orguserseccon,
        'SecondaryOfficePhone'=>$request->orguserophone,
        'role'=>2,
       ];
        $result1 = DB::table('users')->insert($data);
        if($result){
        return redirect()->route('add.newuser')->with('success', "User Added Succesfully");
        }else{
        return bacK()->with('failed', "Something Went Wrong");
        }
    }

  //____________________Quick Signup page____________________
    //QuickSignup Page get region data
    public function quicksignup(){
     $data= DB::table('regions')->get();
     return view('backend.quick_signup',compact('data'));  
    }
    //QuickSignup Page get org category data for selected region
    public function getquickcat(Request $request)
        {
        $regionId = $request->input('regionId');
        $orgCatData = DB::table('orgcats')->where('RegionID', $regionId)->pluck('CatagoryName', 'id')->toArray();
        return response()->json($orgCatData);
        }
   // Quick signup data store in db
   public function getquicksignup(Request $request){
   try {
        $request->validate([
            'Region' => 'required',
            'category' => 'required',
            'orgname' => 'required',
            'uname' => 'required',
            'password' => 'required|min:4'
        ]);
        $password=Hash::make($request->password);
        $org=[
            'RegionID'=>$request->Region,
            'OrgCatID'=>$request->category,
            'Name'=>$request->orgname,
        ];
        $data=DB::table('orgs')->insertGetId($org);
        $user=[
            'OrgID'=>$data,
            'UserName'=>$request->uname,
            'PasswordHash'=>$password,
        ];
        $result=DB::table('users')->insert($user);
        if($result==true){
            return back()->with('success','Sign Up Succesfull!');
        }else{
            return back()->with('error','Something Went Wrong!');
        }
    } catch (\Illuminate\Validation\ValidationException $e) {
        $errors = $e->validator->errors();
     
        return  back()->withErrors($errors)->withInput();
    }
}
}
