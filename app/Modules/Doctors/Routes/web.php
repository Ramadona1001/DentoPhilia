<?php

use Illuminate\Support\Facades\Route;

$namespace = "Doctors\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::group(['middleware' => ['web']], function () {
                Route::prefix("doctors")->group(function () {
                    Route::get('/', 'DoctorController@index')->name('doctors');
                    Route::get('/create', 'DoctorController@create')->name('create_doctors');
                    Route::post('/store', 'DoctorController@store')->name('store_doctors');
                    Route::get('/edit/{id}', 'DoctorController@edit')->name('edit_doctors');
                    Route::post('/update/{id}', 'DoctorController@update')->name('update_doctors');
                    Route::get('/delete/{id}', 'DoctorController@delete')->name('delete_doctors');
                    Route::get('/complete-profile', 'DoctorController@completeProfile')->name('complete_profile_doctors');
                    Route::post('/completeprofile', 'DoctorController@completeProfilePost')->name('complete_profile_post_doctors');
                    // Route::get('/profile', 'DoctorController@profile')->name('profile_doctors');
                    Route::get('/cases', 'DoctorController@cases')->name('cases_doctors');
                });
            });
        });
    });
