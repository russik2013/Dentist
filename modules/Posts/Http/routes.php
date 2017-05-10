<?php

Route::group(['middleware' => 'web', 'prefix' => 'posts', 'namespace' => 'Modules\Posts\Http\Controllers'], function()
{
	Route::any('/', 'PostsController@index');
    Route::any('/parse', 'PostsController@parse');
    Route::any('/parse/finance/{id}', 'PostsController@parseFinance');

    Route::any('/parseXLS', 'PostsController@parseXLS');
    Route::post('/parseXLSdo', 'PostsController@doParseXLS');
});