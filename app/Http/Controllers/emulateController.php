<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class emulateController extends Controller
{
    public function emulateLogin(Request $request)
    {
        $orgID = $request->input('orgID');
        $user=DB::table('users')->where('OrgID',$orgID)->first(); 
    //dd($user);
    if ($user) {
        // Authenticate the user using their orgID
        $request->session()->put('loginId', $user->id);
        $request->session()->put('role', $user->SecurityLevel);
        session(['loginId' => $user->id, 'role' => $user->SecurityLevel]);
        return redirect()->route('backend.uorg_inform');
    }
        // $fail=[
        //     'username'=>$request->email,
        //     'password'=>$request->password,
        //     'address'=>$ip,
        // ];
        // $request->validate([
        //     'email' => 'required',
        //     'password'=>'required|min:4|max:20'
        // ]);
        // $user = DB::table('users')->where('UserName', $request->email)->first();
        // if ($user) {
            //    if (Hash::check($request->password, $user->PasswordHash)) {
            // //if (Crypt::decrypt($user->PasswordHash) == $request->password) {
            //     $request->session()->put('loginId',$user->id);
            //     $request->session()->put('role',$user->SecurityLevel);
            //     session(['loginId' => $user->id, 'role' => $user->SecurityLevel]);
            //     RateLimiter::clear("login.".$request->ip());
            //     return redirect()->route('backend.dashboard');
        //     }else{
        //     DB::table('failed_login')->insert($fail);
        //     return back()->with('failed', 'Failed! Invalid password');
        //     }
        // }else{
        //     DB::table('failed_login')->insert($fail);
        //     return back()->with('failed', 'Failed! Invalid email');
        // }
    }
}
