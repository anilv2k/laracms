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

Route::get('/login', 'UserController@login')->middleware('guest:web')->name('user.login');

Route::get('/registration', 'UserController@registration')->middleware('guest:web')->name('user.registration');



//Route::get('/login', 'UserController@login');

Route::prefix('user')->group(function() {
	
	Route::get('/', 'UserController@index');
	Route::post('/dologin', 'UserController@dologin');
	Route::post('/doregistration', 'UserController@doregistration');
	
	Route::get('/dashboard', 'UserController@dashboard')->middleware('auth:web')->name('user.dashboard');
	Route::get('/mycourses', 'UserController@mycourses');
    Route::get('/list', 'UserController@list');
	Route::get('/logout','UserController@logout');
	
	
	
	Route::get('/calendar', 'CalendarController@index')->middleware('auth:web')->name('user.calendar');
	Route::get('/messages', 'MessagesController@index')->middleware('auth:web')->name('user.messages');
	Route::get('/library', 'LibraryController@index')->middleware('auth:web')->name('user.libarary');
	Route::get('/profile', 'ProfileController@index')->middleware('auth:web')->name('user.profile');
	
	Route::post('/profile', 'ProfileController@profileupdate')->middleware('auth:web')->name('user.profile');
	Route::post('/password', 'ProfileController@password')->middleware('auth:web')->name('user.password');
	


	
});

Route::prefix('user')->group(function() {
		
    Route::post('ajax_list', 'UserController@ajax_list' )->name('ajax_list');
	Route::post('ajax_options', 'UserController@ajax_options' )->name('ajax_options');
	
});