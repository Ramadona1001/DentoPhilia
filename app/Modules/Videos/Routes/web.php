<?php

use Illuminate\Support\Facades\Route;

$namespace = "Videos\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::group(['middleware' => ['web']], function () {

                Route::prefix("videos")->group(function () {
                    Route::get('/', 'VideoController@index')->name('videos');
                    Route::get('/create', 'VideoController@create')->name('create_videos');
                    Route::get('/{username}', 'VideoController@profileVideos')->name('profile_videos');
                    Route::post('/store', 'VideoController@store')->name('store_videos');
                    Route::get('/edit/{id}', 'VideoController@edit')->name('edit_videos');
                    Route::post('/update/{id}', 'VideoController@update')->name('update_videos');
                    Route::get('/delete/{id}', 'VideoController@delete')->name('delete_videos');
                });
            });
        });
    });
