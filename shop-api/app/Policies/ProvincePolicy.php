<?php

namespace App\Policies;

use App\Models\Province;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProvincePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list provinces.
     *
     * @param  User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->canUser('province_list');
    }

    /**
     * Determine whether the user can store provinces.
     *
     * @param  User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->canUser('province_store');
    }

    /**
     * Determine whether the user can update the province.
     *
     * @param  User  $user
     * @param  Province  $province
     * @return mixed
     */
    public function update(User $user, Province $province)
    {
        return $user->canUser('province_update');
    }

    /**
     * Determine whether the user can destroy the province.
     *
     * @param  User  $user
     * @param  Province  $province
     * @return mixed
     */
    public function destroy(User $user, Province $province)
    {
        return $user->canUser('province_destroy');
    }

}
