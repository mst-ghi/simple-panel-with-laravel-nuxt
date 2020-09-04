<?php

use Illuminate\Support\Facades\Route;

Route::post('login', [
    'uses' => 'LoginController',
    'as'   => 'login',
]);

Route::group(['middleware' => ['auth:api']], function (){

    Route::get('user', [
        'uses' => 'UserInfoController',
        'as'   => 'user.info',
    ]);

    Route::get('logout', [
        'uses' => 'LogoutController',
        'as'   => 'logout',
    ]);

});

