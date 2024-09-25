<?php

namespace App\Providers;

use App\Models\Admin\Contactus;
use App\Models\Admin\Setting;
use App\Models\Admin\SocialMedia;
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
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
              //Retrieve settings data from database or cache
              $settings = Setting::first(); 
              $contact  = Contactus::first();
              $social   = SocialMedia::first();
              \View::share(['settings' => $settings , 'contact'=>$contact , 'social'=>$social]);

    }
}
