<?php

namespace App\Policies;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any brands.
     *
     * @param  User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->canUser('brand_list');
    }

    /**
     * Determine whether the user can store brands.
     *
     * @param  User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->canUser('brand_store');
    }

    /**
     * Determine whether the user can update the brand.
     *
     * @param  User  $user
     * @param  Brand  $brand
     * @return mixed
     */
    public function update(User $user, Brand $brand)
    {
        return $user->canUser('brand_update');
    }

    /**
     * Determine whether the user can delete the brand.
     *
     * @param  User  $user
     * @param  Brand  $brand
     * @return mixed
     */
    public function destroy(User $user, Brand $brand)
    {
        return $user->canUser('brand_destroy');
    }
}
