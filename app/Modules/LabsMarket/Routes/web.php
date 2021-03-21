<?php

use Illuminate\Support\Facades\Route;

$namespace = "LabsMarket\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::group(['middleware' => ['web']], function () {
                Route::prefix("labs_market")->group(function () {
                    Route::get('/', 'LabsMarketController@index')->name('labs_market');
                    Route::get('/all', 'LabsMarketController@allLabsProducts')->name('all_labs_market');
                    Route::get('/filter/second-cat/{firstcat}', 'LabsMarketController@filterSecondCat')->name('filter_second_cat_labs_market');
                    Route::post('/filter', 'LabsMarketController@filter')->name('filter_labs_market');
                });
            });
        });
    });
