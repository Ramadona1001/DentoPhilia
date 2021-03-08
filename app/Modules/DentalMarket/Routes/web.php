<?php

use Illuminate\Support\Facades\Route;

$namespace = "DentalMarket\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::group(['middleware' => ['web']], function () {
                Route::prefix("dental_market")->group(function () {
                    Route::get('/', 'DentalMarketController@index')->name('dental_market');
                    Route::get('/filter/second-cat/{firstcat}', 'DentalMarketController@filterSecondCat')->name('filter_second_cat_dental_market');
                    Route::post('/filter', 'DentalMarketController@filter')->name('filter_dental_market');
                });
            });
        });
    });
