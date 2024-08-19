<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class OnOffUserStatusServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // view()->composer('*',function($view){
        View::composer('*',function($view){

            $onlineusers = User::Onlineusers();

            $view->with([
                'onlineusers'=>$onlineusers
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}


// php artisan make:provider OnOffUserStatusServiceProvider
