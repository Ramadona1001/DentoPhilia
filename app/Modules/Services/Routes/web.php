<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web','auth']], function() {
    $namespace = "Services\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::prefix("backend/services")->group(function () {
                Route::get('/all', 'ServiceController@index')->name('services');
                Route::get('/create', 'ServiceController@create')->name('create_services');
                Route::post('/store', 'ServiceController@store')->name('store_services');
                Route::get('/edit/{id}', 'ServiceController@edit')->name('edit_services');
                Route::post('/update/{id}', 'ServiceController@update')->name('update_services');
                Route::get('/show/{id}', 'ServiceController@show')->name('show_services');
                Route::get('/delete/{id}', 'ServiceController@destroy')->name('destroy_services');
                Route::post('/upload', 'ServiceController@upload')->name('upload_services');
            });
        });
    });
});
