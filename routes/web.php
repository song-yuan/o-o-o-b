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
Route::group(['prefix' => 'auth'], function () {
    Route::get('/', 'Auth\LoginController@index');
    Route::post('/login', 'Auth\LoginController@login');
});

Route::group(['prefix' => 'bill'], function () {
    Route::get('/', 'BillController@index');
    Route::get('/create', 'BillController@create');
    Route::post('/create', 'BillController@store');
    Route::get('/remark', 'BillController@remark');
    Route::post('/remark', 'BillController@login');

    Route::post('/import', 'BillController@import');
    Route::post('/importlog', 'BillController@importlog');
    Route::get('/billtpl', 'BillController@billtpl');
    Route::get('/logtpl', 'BillController@logtpl');
    Route::get('/logs/{billSn}', 'BillController@logs');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'UserController@index');
});
