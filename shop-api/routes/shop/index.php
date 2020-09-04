<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Auth')
     ->prefix('auth')
     ->as('auth.')
     ->group(shop_route_path('auth'));
