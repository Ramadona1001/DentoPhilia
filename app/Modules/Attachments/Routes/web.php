<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web','auth']], function() {
    $namespace = "Attachments\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::prefix("backend/attachments")->group(function () {
                Route::get('/all', 'AttachmentController@index')->name('attachments');
                Route::get('/create', 'AttachmentController@create')->name('create_attachments');
                Route::post('/store', 'AttachmentController@store')->name('store_attachments');
                Route::get('/show/{id}', 'AttachmentController@show')->name('show_attachments');
                Route::get('/edit/{id}', 'AttachmentController@edit')->name('edit_attachments');
                Route::post('/update/{id}', 'AttachmentController@update')->name('update_attachments');
                Route::get('/show/{id}', 'AttachmentController@show')->name('show_attachments');
                Route::get('/delete/{id}', 'AttachmentController@destroy')->name('destroy_attachments');
                Route::post('/upload', 'AttachmentController@upload')->name('upload_attachments');

            });
        });
    });
});
