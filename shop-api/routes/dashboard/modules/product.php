<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [
    'uses' => 'ProductListController',
    'as'   => 'list',
]);

Route::get('/{product}', [
    'uses' => 'ProductShowController',
    'as'   => 'show',
]);

Route::post('/', [
    'uses' => 'ProductStoreController',
    'as'   => 'store',
]);

Route::patch('/{product}', [
    'uses' => 'ProductUpdateController',
    'as'   => 'update',
]);

//Route::delete('/{product}', [
//    'uses' => 'ProductDestroyController',
//    'as'   => 'destroy',
//]);

Route::get('/{product}/status', [
    'uses' => 'ProductStatusController',
    'as'   => 'status',
]);



