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
	
	
Route::prefix('admin')->group(function() {
	
	Route::get('/', 'AdminAuthController@index')->middleware('guest:admin')->name('admin.login');
	
	Route::get('/login','AdminAuthController@index')->middleware('guest:admin')->name('admin.login');
    Route::post('/dologin','AdminAuthController@postLogin');
    Route::get('/dashboard','AdminAuthController@getDashboard')->middleware('auth:admin')->name('admin.dashboard');
    Route::get('/logout','AdminAuthController@logout');
	
	Route::get('/users', 'UsersController@index')->middleware('auth:admin')->name('admin.dashboard');
	

});


Route::prefix('admin')->group(function() {
		
    Route::post('ajax_list', 'UsersController@ajax_list' )->name('ajax_list');
	Route::post('ajax_options', 'UsersController@ajax_options' )->name('ajax_options');
	
});

