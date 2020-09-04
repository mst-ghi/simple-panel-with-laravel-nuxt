<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [
    'uses' => 'RoleListController',
    'as'   => 'list',
]);

Route::post('/', [
    'uses' => 'RoleStoreController',
    'as'   => 'store',
]);

Route::get('/{role}/permissions', [
    'uses' => 'RolePermissionListController',
    'as'   => 'permissions.list',
]);

Route::post('/{role}/permissions', [
    'uses' => 'RolePermissionSyncController',
    'as'   => 'permissions.sync',
]);

Route::patch('/{role}', [
    'uses' => 'RoleUpdateController',
    'as'   => 'update',
]);

Route::delete('/{role}', [
    'uses' => 'RoleDestroyController',
    'as'   => 'destroy',
]);
