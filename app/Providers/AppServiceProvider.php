<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider

{
    
    // public $userId;
    // public $admin;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        // $this->userId = Session::get('loginId');
        // $this->admin = User::where('id','=', $this->userId)->first();
        
        // View::composer('layouts.layout', function($view) {
        //     $view->with('user', $this->admin );
        // });
    }
}