<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        // RateLimiter::for('api', function (Request $request) {
        //     return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        // });

        // RateLimiter::for('loginattempt', function (Request $request) {
        //     return Limit::perMinute(5)->response(function () {
        //         return redirect()->route('backend.signin')->with('error', ' <div class="col-md-8"><b>Too Many Login Failures</b> <br> Please wait two minutes before trying again. </div>');
        //     })->by($request->ip());
        // });

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });

        RateLimiter::for('loginattempt', function(Request $request){
            $key = "loginattempt.".$request->ip();
            $max = 5; // attempt
            $decay = 120; // seconds
            if(RateLimiter::tooManyAttempts($key,$max)){
                return back()->with("error",' <div class="col-md-8"><b>Too Many Login Failures</b> <br> Please wait two minutes before trying again. </div>');
            } else {
                RateLimiter::hit($key,$decay);
            }
        });
    }
}
