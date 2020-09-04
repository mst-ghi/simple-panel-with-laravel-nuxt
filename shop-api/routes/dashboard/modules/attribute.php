<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Attribute'], function (){

    Route::get('/', [
        'uses' => 'AttributeListController',
        'as'   => 'list',
    ]);

    Route::post('/', [
        'uses' => 'AttributeStoreController',
        'as'   => 'store',
    ]);

    Route::patch('/{attribute}', [
        'uses' => 'AttributeUpdateController',
        'as'   => 'update',
    ]);

    Route::delete('/{attribute}', [
        'uses' => 'AttributeDestroyController',
        'as'   => 'destroy',
    ]);

});

