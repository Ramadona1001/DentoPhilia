<?php

use Illuminate\Support\Facades\Route;

$namespace = "Cases\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::group(['middleware' => ['web']], function () {
                Route::prefix("cases")->group(function () {
                    Route::get('/doctor-cases/{type}', 'CaseController@allDoctorCases')->name('all_doctor_cases');
                    Route::get('/doctor-cases/create/{type}', 'CaseController@createDoctorCases')->name('create_doctor_cases');
                    Route::post('/doctor-cases/store/{type}', 'CaseController@storeDoctorCases')->name('store_doctor_cases');
                    Route::get('/doctor-cases/edit/{id}/{type}', 'CaseController@editDoctorCases')->name('edit_doctor_cases');
                    Route::post('/doctor-cases/update/{id}/{type}', 'CaseController@updateDoctorCases')->name('update_doctor_cases');
                    Route::get('/doctor-cases/delete/{id}/{type}', 'CaseController@deleteDoctorCases')->name('delete_doctor_cases');

                });
            });
        });
    });
