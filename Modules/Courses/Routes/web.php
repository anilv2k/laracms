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
	Route::get('/contentdetails/{id}/{fid}', 'CoursesController@contentdetails')->middleware('auth:web')->name('user.contentdetails');
	
});

	
Route::get('/mycourses', 'CoursesController@user');
 
Route::get('/universites', 'UniversitesController@index');

Route::get('/colleges', 'CollegesController@index');

Route::get('/aboutus', 'UniversitesController@aboutus');
Route::get('/contactus', 'UniversitesController@contactus');



Route::prefix('admin')->group(function() {

    Route::get('/universiteslist', 'UniversitesController@list')->middleware('auth:admin');
    Route::get('/collegeslist', 'CollegesController@list')->middleware('auth:admin');
	Route::get('/courseslist', 'CoursesController@list')->middleware('auth:admin');
	Route::get('/calendarevents', 'CalendareventsController@index')->middleware('auth:admin');
	
    Route::get('/coursestypelist', 'CoursetypeController@list')->middleware('auth:admin');
	
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
    
    Route::get('{course}/curriculum','CurriculumController@index');
    Route::get('{course_id}/curriculum/sections','CurriculumController@get_sections');
    Route::get('curriculum/{curriculum}','CurriculumController@show');

    Route::post('curriculum','CurriculumController@store_section');
    Route::post('curriculum/{curriculum}','CurriculumController@update_section');
    Route::delete('curriculum/{curriculum}','CurriculumController@delete_section');
    
	
});


Route::prefix('coursetype')->group(function() {
		
    Route::post('ajax_list', 'CoursetypeController@ajax_list' );
    Route::post('ajax_options', 'CoursetypeController@ajax_options' );
	
});	
	
Route::prefix('admin/courses')->group(function() {
    Route::post('/curriculum/lesson','CurriculumController@store_lesson')->middleware('auth:admin');
    Route::post('/curriculum/lesson/{curriculum}','CurriculumController@update_lesson')->middleware('auth:admin');
    Route::delete('/curriculum/lesson/{curriculum}','CurriculumController@delete_lesson')->middleware('auth:admin');
});

// Route::get('file','FileController@create');
// Route::post('file','FileController@store');