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

Route::prefix('exam')->group(function() {
    Route::get('/', 'ExamController@index');
    Route::get('/submitanswer', 'ExamController@submitanswer');
	
});




Route::prefix('admin')->group(function() {

 
	Route::get('/questions', 'QuestionsController@list');
	
});



Route::prefix('questions')->group(function() {
		
    Route::post('ajax_list', 'QuestionsController@ajax_list' )->name('questions_list');
	Route::post('ajax_options', 'QuestionsController@ajax_options' )->name('questions_options');
	
});