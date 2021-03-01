<?php

use Illuminate\Support\Facades\Route;

$namespace = "ItemsCategories\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::group(['middleware' => ['web']], function () {
                Route::prefix("item-categories")->group(function () {
                    Route::get('/', function () {
                        hasPermissions('show_items_categories');
                        $title = transWord('Items Categories');
                        return view('ItemsCategories::index',compact('title'));
                    })->name('items_categories');
                });

                Route::prefix("item-categories/first")->group(function () {
                    Route::get('/', 'firstItemCategoryController@index')->name('first_item_categories');
                    Route::get('/create', 'firstItemCategoryController@create')->name('create_first_item_categories');
                    Route::post('/store', 'firstItemCategoryController@store')->name('store_first_item_categories');
                    Route::get('/edit/{id}', 'firstItemCategoryController@edit')->name('edit_first_item_categories');
                    Route::post('/update/{id}', 'firstItemCategoryController@update')->name('update_first_item_categories');
                    Route::get('/delete/{id}', 'firstItemCategoryController@delete')->name('delete_first_item_categories');
                });

                Route::prefix("item-categories/second")->group(function () {
                    Route::get('/', 'secondItemCategoryController@index')->name('second_item_categories');
                    Route::get('/data-ajax/{firstcat}', 'secondItemCategoryController@dataAjax')->name('second_item_categories_data_ajax');
                    Route::get('/create/{id}', 'secondItemCategoryController@create')->name('create_second_item_categories');
                    Route::post('/store/{id}', 'secondItemCategoryController@store')->name('store_second_item_categories');
                    Route::get('/edit/{id}', 'secondItemCategoryController@edit')->name('edit_second_item_categories');
                    Route::post('/update/{id}', 'secondItemCategoryController@update')->name('update_second_item_categories');
                    Route::get('/delete/{id}', 'secondItemCategoryController@delete')->name('delete_second_item_categories');
                });

                Route::prefix("item-categories/third")->group(function () {
                    Route::get('/', 'thirdItemCategoryController@index')->name('third_item_categories');
                    Route::get('/data-ajax/{secondcat}', 'thirdItemCategoryController@dataAjax')->name('third_item_categories_data_ajax');
                    Route::get('/create/{id}', 'thirdItemCategoryController@create')->name('create_third_item_categories');
                    Route::post('/store/{id}', 'thirdItemCategoryController@store')->name('store_third_item_categories');
                    Route::get('/edit/{id}', 'thirdItemCategoryController@edit')->name('edit_third_item_categories');
                    Route::post('/update/{id}', 'thirdItemCategoryController@update')->name('update_third_item_categories');
                    Route::get('/delete/{id}', 'thirdItemCategoryController@delete')->name('delete_third_item_categories');
                });
            });
        });
    });
