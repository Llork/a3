<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator; // added this for custom validation rule

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Custom validation rule to accept only alpha and space. Credit to
        // Chris Landeza at http://stackoverflow.com/questions/34099777/laravel-5-1-validation-rule-alpha-cannot-take-whitespace
    	Validator::extend('alpha_space', function ($attribute, $value) {
        	return preg_match('/^[\pL\s]+$/u', $value);
    	});
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
