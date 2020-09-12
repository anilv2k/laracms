<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', 'CmsController@index');


/*
 * route moved to bottom 
if(empty(request()->segment(2))){
    //condition to check if the route does not belong to any module
    if(!in_array(request()->segment(1),\Nwidart\Modules\Facades\Module::all())){
		
     $slug = request()->segment(1); 
	 $sulgvalue= \Modules\Cms\Entities\Pages::where('slug',$slug)->first();

	 if(isset($sulgvalue->slug))
     Route::get('/{page:slug}', 'CMSController@page');
	  
    }
}
 */

Route::prefix('admin')->group(function() {
	
	Route::get('/dashboard', 'DashboardController@index');
	Route::get('/settings', 'SettingsController@index');
	Route::post('/save_settings', 'SettingsController@store');
		
	Route::get('/theme', 'ThemeController@set');
		

});


Route::prefix('cms')->group(function() {
	
	Route::get('/pages/{type?}', 'PagesController@list')->middleware('auth:admin');
	
    Route::post('ajax_list', 'PagesController@ajax_list' )->name('ajax_list');
	Route::post('ajax_options', 'PagesController@ajax_options' )->name('ajax_options');
	
});



Route::prefix('admin')->group(function() {
    Route::get('/media', 'FileManagerController@index');
});


/*

Route::prefix('admin/cms')->group(function() {
    Route::get('/list/{type?}', 'CMSController@list')->middleware('auth:admin');
    Route::post('/list','CMSController@ajax_list')->middleware('auth:admin');
    Route::post('/','CMSController@store')->middleware('auth:admin');
    Route::get('/{page}','CMSController@edit')->middleware('auth:admin');
    Route::get('/view/{page}','CMSController@show')->middleware('auth:admin');
    Route::post('/{page}','CMSController@update')->middleware('auth:admin');
});


*/

Route::get('/{page}', 'CmsController@page');