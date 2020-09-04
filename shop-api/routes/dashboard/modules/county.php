<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'County'], function (){

    Route::get('/', [
        'uses' => 'CountyListController',
        'as'   => 'list',
    ]);

    Route::post('/', [
        'uses' => 'CountyStoreController',
        'as'   => 'store',
    ]);

    Route::patch('/{county}', [
        'uses' => 'CountyUpdateController',
        'as'   => 'update',
    ]);

    Route::delete('/{county}', [
        'uses' => 'CountyDestroyController',
        'as'   => 'destroy',
    ]);

});

