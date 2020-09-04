<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [
    'uses' => 'PermissionListController',
    'as'   => 'list',
]);

