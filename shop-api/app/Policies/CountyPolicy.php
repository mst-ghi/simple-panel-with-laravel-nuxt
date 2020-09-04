<?php

namespace App\Policies;

use App\Models\County;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list counties.
     *
     * @param  User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->canUser('county_list');
    }

    /**
     * Determine whether the user can store counties.
     *
     * @param  User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->canUser('county_store');
    }

    /**
     * Determine whether the user can update the county.
     *
     * @param  User  $user
     * @param  County  $county
     * @return mixed
     */
    public function update(User $user, County $county)
    {
        return $user->canUser('county_update');
    }

    /**
     * Determine whether the user can destroy the county.
     *
     * @param  User  $user
     * @param  County  $county
     * @return mixed
     */
    public function destroy(User $user, County $county)
    {
        return $user->canUser('county_destroy');
    }

}
