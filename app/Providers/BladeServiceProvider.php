<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
   
	    Blade::directive('display', function($user) {
		return "Welcome to +++++++++++ ".$user;
		}); 

		/* echo "2222222222222222222222".__DIR__.'/path/to/views';
		 $this->loadViewsFrom(__DIR__.'/path/to/views', 'courier');
		 */
		 
		 
    }
}
