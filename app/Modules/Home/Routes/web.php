<?php

use Illuminate\Support\Facades\Route;

$namespace = "Home\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::group(['middleware' => ['web']], function () {
                Route::get('/', 'HomeController@index')->name('website');
            });
        });
    });
