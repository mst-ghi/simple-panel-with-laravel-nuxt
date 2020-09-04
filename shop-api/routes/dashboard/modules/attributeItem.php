<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Item'], function (){

    Route::get('/', [
        'uses' => 'AttributeItemListController',
        'as'   => 'list',
    ]);

    Route::post('/', [
        'uses' => 'AttributeItemStoreController',
        'as'   => 'store',
    ]);

    Route::patch('/{item}', [
        'uses' => 'AttributeItemUpdateController',
        'as'   => 'update',
    ]);

    Route::delete('/{item}', [
        'uses' => 'AttributeItemDestroyController',
        'as'   => 'destroy',
    ]);

});

