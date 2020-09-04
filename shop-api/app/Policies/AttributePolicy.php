<?php

namespace App\Policies;

use App\Models\Attribute;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttributePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list any attributes.
     *
     * @param  User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->canUser('attribute_list');
    }

    /**
     * Determine whether the user can store attributes.
     *
     * @param  User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->canUser('attribute_store');
    }

    /**
     * Determine whether the user can update the attribute.
     *
     * @param  User  $user
     * @param  Attribute  $attribute
     * @return mixed
     */
    public function update(User $user, Attribute $attribute)
    {
        return $user->canUser('attribute_update');
    }

    /**
     * Determine whether the user can destroy the attribute.
     *
     * @param  User  $user
     * @param  Attribute  $attribute
     * @return mixed
     */
    public function destroy(User $user, Attribute $attribute)
    {
        return $user->canUser('attribute_destroy');
    }

}
