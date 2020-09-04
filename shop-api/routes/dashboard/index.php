<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Auth')
     ->prefix('auth')
     ->as('auth.')
     ->group(dashboard_route_path('auth'));

Route::group(['middleware' => 'auth:api'], function () {

    Route::namespace('User')
         ->prefix('users')
         ->as('users.')
         ->group(dashboard_route_path('user'));

    Route::namespace('Role')
         ->prefix('roles')
         ->as('roles.')
         ->group(dashboard_route_path('role'));

    Route::namespace('Permission')
         ->prefix('permissions')
         ->as('permissions.')
         ->group(dashboard_route_path('permission'));

    Route::namespace('Location')
         ->prefix('provinces')
         ->as('provinces.')
         ->group(dashboard_route_path('province'));

    Route::namespace('Location')
         ->prefix('counties')
         ->as('counties.')
         ->group(dashboard_route_path('county'));

    Route::namespace('Location')
         ->prefix('cities')
         ->as('cities.')
         ->group(dashboard_route_path('city'));

    Route::namespace('Brand')
         ->prefix('brands')
         ->as('brands.')
         ->group(dashboard_route_path('brand'));

    Route::namespace('Category')
         ->prefix('categories')
         ->as('categories.')
         ->group(dashboard_route_path('category'));

    Route::namespace('Product')
         ->prefix('products')
         ->as('products.')
         ->group(dashboard_route_path('product'));

    Route::namespace('Attribute')
         ->prefix('attributes/groups')
         ->as('attributes.groups.')
         ->group(dashboard_route_path('attributeGroup'));

    Route::namespace('Attribute')
         ->prefix('attributes')
         ->as('attributes.')
         ->group(dashboard_route_path('attribute'));

    Route::namespace('Attribute')
         ->prefix('attributes/items')
         ->as('attributes.items.')
         ->group(dashboard_route_path('attributeItem'));

    Route::namespace('Address')
         ->prefix('addresses')
         ->as('addresses.')
         ->group(dashboard_route_path('address'));

    Route::namespace('Banner')
         ->prefix('banners')
         ->as('banners.')
         ->group(dashboard_route_path('banner'));


});
