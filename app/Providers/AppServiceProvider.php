<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::share('ver', 2);
        if( \Request::server ("HTTP_HOST") == "127.0.0.1:8000" or \Request::server ("HTTP_HOST") == "127.0.0.1:3000" ){
            \View::share('asset', '');
        } else {
            \View::share('asset', '');
        }


        app()->singleton('Lang', function()
        {
            if(auth()->user()){
                if(empty(auth()->user()->language)){
                    return 'ar';
                } else {
                    return auth()->user()->language;
                }
            } else {
                if(session()->has('lang')){
                    return session()->get('lang');
                } else {
                    return 'ar';
                }
            }
        });
    }
}
