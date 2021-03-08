<?php

use Illuminate\Support\Facades\Route;

$namespace = "CasesMarket\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::group(['middleware' => ['web']], function () {
                Route::prefix("cases_market")->group(function () {
                    Route::get('/', 'CasesMarketController@index')->name('cases_market');
                    Route::post('/filter', 'CasesMarketController@filter')->name('filter_cases_market');
                });
            });
        });
    });
