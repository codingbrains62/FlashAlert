<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AlreadyLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

     //old code by sks
    // public function handle(Request $request, Closure $next)
    // {
    //     if(Session()->has('loginId') && (url('IIN/login')==$request->url() || url('/')==$request->url())){
    //         return back();
    //       }
    //       return $next($request);
    // }

    //new code by sks
    public function handle(Request $request, Closure $next)
{
    // Check if the user is already logged in
    if(Session::has('loginId')) {
        // Check if the user is trying to access the client login page
        if ($request->url() === route('backend.signin')) {
            // Redirect them to the dashboard
            return redirect()->route('backend.dashboard');
        }
    }

    // Allow the request to continue
    return $next($request);
}



}
