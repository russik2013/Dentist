<?php

Route::group(['middleware' => 'web', 'prefix' => 'message', 'namespace' => 'Modules\Message\Http\Controllers'], function()
{
	Route::get('/', 'MessageController@index');
    Route::any('/message', 'MessageController@message');
});