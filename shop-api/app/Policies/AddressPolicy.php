<?php

namespace App\Policies;

use App\Models\Address;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list any addresses.
     *
     * @param  User  $user
     *
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->canUser('address_list');
    }

    /**
     * Determine whether the user can store addresses.
     *
     * @param  User  $user
     *
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->canUser('address_store');
    }

    /**
     * Determine whether the user can update the address.
     *
     * @param  User     $user
     *
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->canUser('address_update');
    }

    /**
     * Determine whether the user can destroy the address.
     *
     * @param  User     $user
     *
     * @return mixed
     */
    public function destroy(User $user)
    {
        return $user->canUser('address_destroy');
    }
}
