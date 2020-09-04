<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [
    'uses' => 'BrandListController',
    'as'   => 'list',
]);

Route::post('/', [
    'uses' => 'BrandStoreController',
    'as'   => 'store',
]);

Route::patch('/{brand}', [
    'uses' => 'BrandUpdateController',
    'as'   => 'update',
]);

Route::delete('/{brand}', [
    'uses' => 'BrandDestroyController',
    'as'   => 'destroy',
]);


