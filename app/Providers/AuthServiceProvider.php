<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
//use DB;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            $headertoken = $request->header('token');
            $tokenexists = DB::table('programs')->where('token', $headertoken)->exists();
            if($tokenexists){
                return $headertoken;
                //  $agentdetails = DB::table('agents')->where('token', $headertoken)->first();
                //  return $agentdetails;
            }
            // if ($request->header('token')) {
            //     return DB::table('agents')->where('token', $request->input('token'))->first();
            //     //return User::where('api_token', $request->input('api_token'))->first();
            // }
        });
    }
}
