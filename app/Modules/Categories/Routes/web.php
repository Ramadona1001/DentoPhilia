<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web','auth']], function() {
    $namespace = "Categories\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::prefix("backend/categories")->group(function () {
                Route::get('/all', 'CategoryController@index')->name('categories');
                Route::get('/create', 'CategoryController@create')->name('create_categories');
                Route::post('/store', 'CategoryController@store')->name('store_categories');
                Route::get('/edit/{id}', 'CategoryController@edit')->name('edit_categories');
                Route::post('/update/{id}', 'CategoryController@update')->name('update_categories');
                Route::get('/show/{id}', 'CategoryController@show')->name('show_categories');
                Route::get('/delete/{id}', 'CategoryController@destroy')->name('destroy_categories');
                Route::post('/upload', 'CategoryController@upload')->name('upload_categories');
            });
        });
    });
});
