<?php

namespace App\Policies;

use App\Models\City;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list cities.
     *
     * @param  User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->canUser('city_list');
    }

    /**
     * Determine whether the user can store cities.
     *
     * @param  User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->canUser('city_store');
    }

    /**
     * Determine whether the user can update the city.
     *
     * @param  User  $user
     * @param  City  $city
     * @return mixed
     */
    public function update(User $user, City $city)
    {
        return $user->canUser('city_update');
    }

    /**
     * Determine whether the user can destroy the city.
     *
     * @param  User  $user
     * @param  City  $city
     * @return mixed
     */
    public function destroy(User $user, City $city)
    {
        return $user->canUser('city_destroy');
    }

}
