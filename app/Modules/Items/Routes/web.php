<?php

use Illuminate\Support\Facades\Route;

$namespace = "Items\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::group(['middleware' => ['web']], function () {
                Route::prefix("items")->group(function () {
                    Route::get('/', 'ItemController@index')->name('items');
                    Route::get('/create', 'ItemController@create')->name('create_items');
                    Route::post('/store', 'ItemController@store')->name('store_items');
                    Route::get('/edit/{id}', 'ItemController@edit')->name('edit_items');
                    Route::post('/update/{id}', 'ItemController@update')->name('update_items');
                    Route::get('/delete/{id}', 'ItemController@delete')->name('delete_items');
                    Route::get('/approve/{id}', 'ItemController@approve')->name('approve_items');
                    Route::get('/disapprove/{id}', 'ItemController@disapprove')->name('disapprove_items');
                });
            });
        });
    });
