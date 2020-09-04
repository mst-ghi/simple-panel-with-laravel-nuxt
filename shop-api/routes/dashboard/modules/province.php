<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Province'], function (){

    Route::get('/', [
        'uses' => 'ProvinceListController',
        'as'   => 'list',
    ]);

    Route::post('/', [
        'uses' => 'ProvinceStoreController',
        'as'   => 'store',
    ]);

    Route::patch('/{province}', [
        'uses' => 'ProvinceUpdateController',
        'as'   => 'update',
    ]);

    Route::delete('/{province}', [
        'uses' => 'ProvinceDestroyController',
        'as'   => 'destroy',
    ]);

});

