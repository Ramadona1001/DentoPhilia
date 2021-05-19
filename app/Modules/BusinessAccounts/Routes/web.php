<?php

use Illuminate\Support\Facades\Route;

$namespace = "BusinessAccounts\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::group(['middleware' => ['web']], function () {
                Route::prefix("business-accounts")->group(function () {
                    Route::get('/', 'BusinessAccountController@index')->name('business_accounts');
                    Route::get('/create', 'BusinessAccountController@create')->name('create_business_accounts');
                    Route::post('/store', 'BusinessAccountController@store')->name('store_business_accounts');
                    Route::get('/show/{id}', 'BusinessAccountController@show')->name('show_business_accounts');
                    Route::get('/edit/{id}', 'BusinessAccountController@edit')->name('edit_business_accounts');
                    Route::post('/update/{id}', 'BusinessAccountController@update')->name('update_business_accounts');
                    Route::get('/delete/{id}', 'BusinessAccountController@delete')->name('delete_business_accounts');
                    Route::get('/approve/{id}', 'BusinessAccountController@approve')->name('approve_business_accounts');
                    Route::get('/disapprove/{id}', 'BusinessAccountController@disapprove')->name('disapprove_business_accounts');
                    Route::get('/complete-profile', 'BusinessAccountController@completeProfile')->name('complete_profile_business_accounts');
                    Route::post('/completeprofile', 'BusinessAccountController@completeProfilePost')->name('complete_profile_post_business_accounts');
                    // Route::get('/profile', 'BusinessAccountController@profile')->name('profile_business_accounts');
                    Route::get('/items', 'BusinessAccountController@items')->name('items_business_accounts');
                });
            });
        });
    });
