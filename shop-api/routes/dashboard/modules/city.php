<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'City'], function (){

    Route::get('/', [
        'uses' => 'CityListController',
        'as'   => 'list',
    ]);

    Route::post('/', [
        'uses' => 'CityStoreController',
        'as'   => 'store',
    ]);

    Route::patch('/{city}', [
        'uses' => 'CityUpdateController',
        'as'   => 'update',
    ]);

    Route::delete('/{city}', [
        'uses' => 'CityDestroyController',
        'as'   => 'destroy',
    ]);

});

