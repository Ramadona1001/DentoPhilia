<?php

use Illuminate\Support\Facades\Route;

$namespace = "Users\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::group(['middleware' => ['web']], function () {
                Route::prefix("users")->group(function () {
                    Route::get('/', 'UserController@index')->name('users');
                    Route::get('/permissions/{id}', 'UserController@permissions')->name('permissions_users');
                    Route::get('/assign/permissions/{id}', 'UserController@assignPermissions')->name('assign_permissions_users');
                    Route::get('/delete/{id}', 'UserController@destroy')->name('destroy_users');
                    Route::post('/logout', 'UserController@logout')->name('logout_users');
                    Route::get('/register-account', 'UserController@register')->name('register_account');
                    Route::get('/create', 'UserController@create')->name('create_users');
                    Route::post('/store', 'UserController@store')->name('store_users');
                    Route::get('/edit/{id}', 'UserController@edit')->name('edit_users');
                    Route::post('/update/{id}', 'UserController@update')->name('update_users');
                    Route::get('/delete/{id}', 'UserController@delete')->name('delete_users');
                });
            });
        });
    });
