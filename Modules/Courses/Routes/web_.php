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

Route::prefix('courses')->group(function() {
    Route::get('/', 'CoursesController@index');
	Route::get('/show', 'CoursesController@show');
	
	Route::get('/details/{id}', 'CoursesController@details');
	
});

Route::get('/universites', 'UniversitesController@index');


Route::prefix('admin')->group(function() {

    Route::get('/universiteslist', 'UniversitesController@list');

    Route::get('/collegeslist', 'CollegesController@list');
	
	Route::get('/courseslist', 'CoursesController@list');
	
	
	Route::get('/calendarevents', 'CalendareventsController@index');
	
	
	
	
});


Route::prefix('calendar')->group(function() {
		
    Route::post('ajax_list', 'CalendareventsController@ajax_list' )->name('calendarevents_list');
	Route::post('ajax_options', 'CalendareventsController@ajax_options' )->name('calendarevents_options');
	Route::get('getevents', 'CalendareventsController@getevents' )->name('calendarevents_options');
	
});



Route::prefix('university')->group(function() {
		
    Route::post('ajax_list', 'UniversitesController@ajax_list' )->name('universityajax_list');
	Route::post('ajax_options', 'UniversitesController@ajax_options' )->name('universityajax_options');
	
	Route::get('/details/{id}', 'UniversitesController@details');
	
});

Route::prefix('colleges')->group(function() {
		
    Route::post('ajax_list', 'CollegesController@ajax_list' )->name('collegesajax_list');
	Route::post('ajax_options', 'CollegesController@ajax_options' )->name('collegesajax_options');
	
});

Route::prefix('courses')->group(function() {
		
    Route::post('ajax_list', 'CoursesController@ajax_list' )->name('collegesajax_list');
	Route::post('ajax_options', 'CoursesController@ajax_options' )->name('collegesajax_options');
	
});


Route::get('file','FileController@create');
Route::post('file','FileController@store');