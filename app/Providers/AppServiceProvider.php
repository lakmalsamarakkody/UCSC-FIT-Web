<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        // CUSTOM VALIDATION RULES
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            // This will only accept alpha and spaces. 
            return preg_match('/^[\pL\s]+$/u', $value); 
        });
        Validator::extend('alpha_dash_spaces', function ($attribute, $value) {
            // This will only accept alpha and spaces and hyphen. 
            return preg_match('/^[\pL\s-]+$/u', $value); 
        });
        Validator::extend('initials', function ($attribute, $value) {
            // This will only accept alpha and spaces and hyphen. 
            return preg_match('/^([A-Z]{1}\s)+[a-zA-Z]{3,}$/', $value); 
        });
        Validator::extend('house_name', function ($attribute, $value) {
            // This will only accept alpha and spaces and hyphen. 
            return preg_match('/^[a-zA-Z]{2,}\s*[:|.]?[a-zA-Z0-9\s]*$/', $value); 
        });
        // /CUSTOM VALIDATION RULES
    }
}
