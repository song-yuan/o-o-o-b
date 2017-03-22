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

Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'UserController@index');
});

Route::group(['prefix' => 'role'], function () {
    Route::get('/', 'Admin\RoleController@index');
    Route::get('/create', 'Admin\RoleController@create');
    Route::post('/create', 'Admin\RoleController@store');

    Route::get('/update/{id}', 'Admin\RoleController@edit');
    Route::post('/update/{id}', 'Admin\RoleController@update');
});

Route::group(['prefix' => 'permission'], function () {
    Route::get('/', 'Admin\PermissionController@index');
    Route::get('/create', 'Admin\PermissionController@create');
    Route::post('/create', 'Admin\PermissionController@store');

    Route::get('/update/{id}', 'Admin\PermissionController@edit');
    Route::post('/update/{id}', 'Admin\PermissionController@update');
});

Route::group(['prefix' => 'bill'], function () {
    Route::get('/', 'BillController@index');
    Route::get('/create', 'BillController@create');
    Route::post('/create', 'BillController@store');

    Route::get('/update/{id}', 'BillController@edit');
    Route::post('/update/{id}', 'BillController@update');
    
    Route::get('/remark/{id}', 'BillController@remark');
    Route::post('/remark/{id}', 'BillController@login');

    Route::post('/import', 'BillController@import');
    Route::post('/importlog', 'BillController@importlog');
    Route::get('/billtpl', 'BillController@billtpl');
    Route::get('/logtpl', 'BillController@logtpl');
    Route::get('/logs/{billSn}', 'BillController@logs');
});

