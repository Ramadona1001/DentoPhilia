<?php

use Illuminate\Support\Facades\Route;

$namespace = "Friends\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::group(['middleware' => ['web']], function () {
                Route::prefix("friends")->group(function () {
                    Route::get('/', 'FriendController@index')->name('friends');
                    Route::get('/{username}', 'FriendController@me')->name('me_friends');
                    Route::post('/add/{touser}', 'FriendController@add')->name('add_friends');
                    Route::post('/delete/{touser}', 'FriendController@delete')->name('delete_friends');
                });
            });
        });
    });
