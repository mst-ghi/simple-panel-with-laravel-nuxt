<?php

namespace App\Policies;

use App\Models\AttributeGroup;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttributeGroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list attribute groups.
     *
     * @param  User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->canUser('attribute_group_list');
    }

    /**
     * Determine whether the user can store attribute groups.
     *
     * @param  User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->canUser('attribute_group_store');
    }

    /**
     * Determine whether the user can update the attribute group.
     *
     * @param  User  $user
     * @param  AttributeGroup  $attributeGroup
     * @return mixed
     */
    public function update(User $user, AttributeGroup $attributeGroup)
    {
        return $user->canUser('attribute_group_update');
    }

    /**
     * Determine whether the user can destroy the attribute group.
     *
     * @param  User  $user
     * @param  AttributeGroup  $attributeGroup
     * @return mixed
     */
    public function destroy(User $user, AttributeGroup $attributeGroup)
    {
        return $user->canUser('attribute_group_destroy');
    }

}
