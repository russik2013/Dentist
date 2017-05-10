<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/loginUser', 'AktorController@checkUser');

Route::auth();




Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'role:admin'], function () {

        Route::get('/admin', 'Admin\AdminCabController@index');
        Route::get('/allClients', 'Admin\AdminCabController@allClients');
        Route::get('/clientInfo/{id}', 'Admin\AdminCabController@getClientInfo');

    });

    Route::group(['middleware' => 'role:client'], function () {

        Route::get('/client', 'Client\ClientCabController@index');

    });

});

