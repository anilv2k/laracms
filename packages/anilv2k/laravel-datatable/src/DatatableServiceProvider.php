<?php

namespace Anilv2k\Datatable;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Anilv2k\Datatable\Datatable;

class DatatableServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
			app()->bind('datatable',function(){

			return new Datatable();
			
			});


    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
       

	    /* Blade::directive('datatable', function ($expression) {
            return "<?php echo '--------'.$expression; ?>";
        });

		Blade::directive('filter_fields', function ($expression) {
            return "<?php echo '--------'.$expression; ?>";
        });
		
		
		$this->loadViewsFrom(__DIR__.'\views', 'filterfields'); */
		
		// $this->loadViewsFrom(__DIR__.'/views', 'datatable');

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
