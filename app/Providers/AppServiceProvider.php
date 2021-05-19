<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Models\Exam\Schedule;

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
        
        // INPUTS
        Validator::extend('alpha_space', function ($attribute, $value) {
            // This will only accept alpha and spaces. 
            return preg_match('/^[\pL\s]+$/u', $value); 
        });
        Validator::extend('alpha_dash_space', function ($attribute, $value) {
            // This will only accept alpha and spaces and hyphen. 
            return preg_match('/^[\pL\s-]+$/u', $value); 
        });
        Validator::extend('alpha_capital', function ($attribute, $value) {
            // This will only accept capital letters seperate with space
            return preg_match('/^[A-Z]+$/', $value); 
        });
        Validator::extend('address', function ($attribute, $value) {
            // This will only accept alphanumerics, spaces,[: . / - _ ].
            return preg_match('/^[a-zA-Z0-9\s\:|\,|\.|\/|\-|_]*$/', $value); 
        });
        Validator::extend('nic_old', function($attribute, $value) {
            //Old NIC number format
            return preg_match('/^[0-9]{9}[V|v]$/',$value);
        });
        Validator::extend('fit_reg_no', function($attribute, $value) {
            //FIT Registration format
            return preg_match('/^[F][0-9]{2}(0[1-9]|10|11|12)([0-2][0-9]|30|31)[0-9]{3}$/',$value);
        });
        // /INPUTS

        // MULTICOLUMN UNIQUE
        Validator::extend('multicolumn_unique', function($attribute, $value) {
            // Exam schedule
        });
        // MULTICOLUMN UNIQUE

        // /CUSTOM VALIDATION RULES
    }
}
