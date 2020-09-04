<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [
    'uses' => 'BannerListController',
    'as'   => 'list',
]);

Route::post('/', [
    'uses' => 'BannerStoreController',
    'as'   => 'store',
]);

Route::patch('/{banner}', [
    'uses' => 'BannerUpdateController',
    'as'   => 'update',
]);

Route::delete('/{banner}', [
    'uses' => 'BannerDestroyController',
    'as'   => 'destroy',
]);


