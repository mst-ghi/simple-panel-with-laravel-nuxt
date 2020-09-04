<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [
    'uses' => 'CategoryListController',
    'as'   => 'list',
]);

Route::post('/', [
    'uses' => 'CategoryStoreController',
    'as'   => 'store',
]);

Route::patch('/{category}', [
    'uses' => 'CategoryUpdateController',
    'as'   => 'update',
]);

Route::delete('/{category}', [
    'uses' => 'CategoryDestroyController',
    'as'   => 'destroy',
]);


