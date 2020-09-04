<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Group'], function (){

    Route::get('/', [
        'uses' => 'AttributeGroupListController',
        'as'   => 'list',
    ]);

    Route::post('/', [
        'uses' => 'AttributeGroupStoreController',
        'as'   => 'store',
    ]);

    Route::patch('/{group}', [
        'uses' => 'AttributeGroupUpdateController',
        'as'   => 'update',
    ]);

    Route::delete('/{group}', [
        'uses' => 'AttributeGroupDestroyController',
        'as'   => 'destroy',
    ]);

});

