<?php

namespace App\Providers;

use App\Models\{
    Address,
    Attribute,
    AttributeGroup,
    AttributeItem,
    Brand,
    Category,
    City,
    County,
    Permission,
    Product,
    Province,
    Role,
    User,
};
use App\Policies\{
    AddressPolicy,
    AttributeGroupPolicy,
    AttributeItemPolicy,
    AttributePolicy,
    BrandPolicy,
    CategoryPolicy,
    CityPolicy,
    CountyPolicy,
    PermissionPolicy,
    ProductPolicy,
    ProvincePolicy,
    RolePolicy,
    UserPolicy,
};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class           => UserPolicy::class,
        Role::class           => RolePolicy::class,
        Permission::class     => PermissionPolicy::class,
        Province::class       => ProvincePolicy::class,
        County::class         => CountyPolicy::class,
        City::class           => CityPolicy::class,
        Brand::class          => BrandPolicy::class,
        Category::class       => CategoryPolicy::class,
        AttributeGroup::class => AttributeGroupPolicy::class,
        Attribute::class      => AttributePolicy::class,
        AttributeItem::class  => AttributeItemPolicy::class,
        Product::class        => ProductPolicy::class,
        Address::class        => AddressPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
