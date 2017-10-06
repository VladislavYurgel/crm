<?php

Route::group(['middleware' => 'api', 'namespace' => 'Api'], function() {
    Route::group(['prefix' => 'v1'], function() {
        Route::group(['namespace' => 'Auth'], function() {
            Route::post('auth/login', 'AuthController@login');
            Route::post('auth/register', 'AuthController@register');
        });

        Route::group(['middleware' => 'jwt'], function() {
            Route::group(['namespace' => 'Company'], function() {
                Route::post('company/create', 'CompanyController@create');
                Route::post('company/{id}/update', 'CompanyController@update');
            });

            Route::group(['namespace' => 'UserCompany'], function() {
                Route::get('user/companies', 'UserCompanyController@getUserCompanies');
            });
        });
    });
});