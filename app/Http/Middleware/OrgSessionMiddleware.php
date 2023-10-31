<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class OrgSessionMiddleware
{
    public function handle($request, Closure $next)
    {
        // if (session()->has('is_org') && session('is_org') === true) {
        //     return $next($request);
        // }
        // Log::info('OrgSessionMiddleware: Redirecting to login for org account');
        // return redirect()->route('login'); // Redirect to the login page for org accounts
    }
}

