<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index')->name("main");
Route::get('/minor', 'HomeController@minor')->name("minor");

Route::group(['prefix' => 'auth'], function () {
    Route::get('/', 'Auth\LoginController@index');
    Route::post('/login', 'Auth\LoginController@login');
    
    
});
