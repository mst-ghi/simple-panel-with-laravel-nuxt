<?php

/**
 * @var array $permissions
 */
$permissions = [

    // Manage Users //
    'user_list',
    'user_show_info',
    'user_update_info',
    'user_store',
    'user_update',
    'user_update_role',
    'user_destroy',
    // -------------- //

    // Manage Roles //
    'role_list',
    'role_store',
    'role_show_permissions',
    'role_update_permissions',
    'role_update',
    'role_destroy',
    'permission_list',
    // -------------- //

    // Manage Locations //
    'province_list',
    'province_store',
    'province_update',
    'province_destroy',
    'county_list',
    'county_store',
    'county_update',
    'county_destroy',
    'city_list',
    'city_store',
    'city_update',
    'city_destroy',
    // -------------- //

    // Manage Brands //
    'brand_list',
    'brand_store',
    'brand_update',
    'brand_destroy',
    // -------------- //

    // Manage Categories //
    'category_list',
    'category_store',
    'category_update',
    'category_destroy',
    // -------------- //

    // Manage Attribute Group //
    'attribute_group_list',
    'attribute_group_store',
    'attribute_group_update',
    'attribute_group_destroy',
    // -------------- //

    // Manage Attributes //
    'attribute_list',
    'attribute_store',
    'attribute_update',
    'attribute_destroy',
    // -------------- //

    // Manage Attribute Items //
    'attribute_item_list',
    'attribute_item_store',
    'attribute_item_update',
    'attribute_item_destroy',
    // -------------- //

    // Manage Products //
    'product_list',
    'product_show',
    'product_store',
    'product_update',
    'product_destroy',
    'product_status',
    // -------------- //

    // Address Attributes //
    'address_list',
    'address_store',
    'address_update',
    'address_destroy',
    // -------------- //

];

return [

    'permissions' => $permissions,

    'roles'                  => [
        'super_user' => [
            'title'       => 'ادمین کل',
            'description' => 'تمامی مجوز های سیستم را داراست.',
            'delete_able' => false,
            'permissions' => $permissions,
        ],

        'customer' => [
            'title'       => 'مشتری',
            'description' => 'بخشی مجوز های سیستم را داراست.',
            'delete_able' => false,
            'permissions' => [
                //
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Role Model
    |--------------------------------------------------------------------------
    */
    'role'                   => 'App\Models\Role',

    /*
    |--------------------------------------------------------------------------
    | Roles Table
    |--------------------------------------------------------------------------
    */
    'roles_table'            => 'roles',

    /*
    |--------------------------------------------------------------------------
    | role foreign key
    |--------------------------------------------------------------------------
    */
    'role_foreign_key'       => 'role_id',

    /*
    |--------------------------------------------------------------------------
    | Application User Model
    |--------------------------------------------------------------------------
    */
    'user'                   => 'App\Models\User',

    /*
    |--------------------------------------------------------------------------
    | Application Users Table
    |--------------------------------------------------------------------------
    */
    'users_table'            => 'users',

    /*
    |--------------------------------------------------------------------------
    | role_user Table
    |--------------------------------------------------------------------------
    */
    'role_user_table'        => 'role_user',

    /*
    |--------------------------------------------------------------------------
    | permission_user Table
    |--------------------------------------------------------------------------
    */
    'permission_user_table'  => 'permission_user',

    /*
    |--------------------------------------------------------------------------
    | user foreign key
    |--------------------------------------------------------------------------
    */
    'user_foreign_key'       => 'user_id',

    /*
    |--------------------------------------------------------------------------
    | Permission Model
    |--------------------------------------------------------------------------
    */
    'permission'             => 'App\Models\Permission',

    /*
    |--------------------------------------------------------------------------
    | Permissions Table
    |--------------------------------------------------------------------------
    */
    'permissions_table'      => 'permissions',

    /*
    |--------------------------------------------------------------------------
    | permission_role Table
    |--------------------------------------------------------------------------
    */
    'permission_role_table'  => 'permission_role',

    /*
    |--------------------------------------------------------------------------
    | permission foreign key
    |--------------------------------------------------------------------------
    */
    'permission_foreign_key' => 'permission_id',

];
