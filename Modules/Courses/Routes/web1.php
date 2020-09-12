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
    Route::get('curriculum/{curriculum}','CurriculumController@show');

    Route::post('curriculum','CurriculumController@store_section');
    Route::post('curriculum/{curriculum}','CurriculumController@update_section');
    
    Route::post('curriculum/lesson','CurriculumController@store_lesson');
    Route::post('curriculum/lesson/{curriculum}','CurriculumController@update_lesson');
	
});


//Route::get('file','FileController@create');
//Route::post('file','FileController@store');