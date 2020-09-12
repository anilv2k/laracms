<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

use Modules\Settings\Entities\Setting;

use Modules\Courses\Entities\University;


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
        
	
	    $sett = new Setting();
        $app_theme= $sett->where('name','site_theme')->first()->value; 
		config(['theme.themeDefault'=>$app_theme]);
		
		
		$univerisity = new University();
		$subsiteurl=url('/');
		config(['app.subsiteurl'=>$subsiteurl]);
		
		
		$university=$univerisity->where('weburl',$subsiteurl)->first();
		
		if(isset($university))
		config(['app.subsiteid'=>$university->id]);
		
		
		
		
    }
}
