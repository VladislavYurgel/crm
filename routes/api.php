<?php

use Illuminate\Http\Request;

Route::group(['middleware' => 'cors'], function() {
    Route::group(['prefix' => 'v1'], function() {
        Route::group(['namespace' => 'Api\Auth'], function() {
            Route::post('auth/login', 'AuthController@login');
            Route::post('auth/register', 'AuthController@register');
        });
    });
});