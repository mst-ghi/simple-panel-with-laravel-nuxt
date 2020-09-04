<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Dashboard')
    ->prefix('panel')
    ->group(base_path('routes/dashboard/index.php'));


Route::namespace('Shop')
    ->prefix('shop')
    ->group(base_path('routes/shop/index.php'));
