<?php

namespace Anilv2k\Datatable;

use Illuminate\Support\ServiceProvider;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
			Route::get('calculator', function(){
			echo 'Hello from the calculator package!';
			});
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
   
    }
}
