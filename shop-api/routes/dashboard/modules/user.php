<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [
    'uses' => 'UserListController',
    'as'   => 'list',
]);

Route::get('/{user}/info', [
    'uses' => 'UserInfoShowController',
    'as'   => 'info.show',
]);

Route::post('/{user}/info', [
    'uses' => 'UserInfoStoreController',
    'as'   => 'info.store',
]);

Route::post('/', [
    'uses' => 'UserStoreController',
    'as'   => 'store',
]);

Route::post('/{user}/role', [
    'uses' => 'UserRoleController',
    'as'   => 'role',
]);

Route::patch('/{user}', [
    'uses' => 'UserUpdateController',
    'as'   => 'update',
]);

Route::delete('/{user}', [
    'uses' => 'UserDestroyController',
    'as'   => 'destroy',
]);
