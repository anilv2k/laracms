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

Route::prefix('chat')->group(function() {
    Route::get('/', 'ChatController@index');
});



Route::prefix('admin')->group(function() {
    Route::get('/chat', 'ChatController@admin');
});
