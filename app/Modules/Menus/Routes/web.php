<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web','auth']], function() {
    $namespace = "Menus\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::prefix("backend/menus")->group(function () {
                Route::get('/all', 'MenuController@index')->name('menus');
                Route::get('/create', 'MenuController@create')->name('create_menus');
                Route::post('/store', 'MenuController@store')->name('store_menus');
                Route::get('/edit/{id}', 'MenuController@edit')->name('edit_menus');
                Route::post('/update/{id}', 'MenuController@update')->name('update_menus');
                Route::get('/show/{id}', 'MenuController@show')->name('show_menus');
                Route::get('/delete/{id}', 'MenuController@destroy')->name('destroy_menus');

                Route::get('/menu-ajax', 'MenuController@ajax')->name('menu_ajax');
            });
        });
    });
});
