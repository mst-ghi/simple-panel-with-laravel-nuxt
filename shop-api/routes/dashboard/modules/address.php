<?php

use Illuminate\Support\Facades\Route;


Route::get('/{user}', [
    'uses' => 'AddressListController',
    'as'   => 'list',
]);

Route::post('/{user}', [
    'uses' => 'AddressStoreController',
    'as'   => 'store',
]);

Route::patch('/{user}/{address}', [
    'uses' => 'AddressUpdateController',
    'as'   => 'update',
]);

Route::delete('/{user}/{address}', [
    'uses' => 'AddressDestroyController',
    'as'   => 'destroy',
]);


