<?php

namespace App\Policies;

use App\Models\AttributeItem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttributeItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list any attribute items.
     *
     * @param  User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->canUser('attribute_item_list');
    }

    /**
     * Determine whether the user can store attribute items.
     *
     * @param  User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->canUser('attribute_item_store');
    }

    /**
     * Determine whether the user can update the attribute item.
     *
     * @param  User  $user
     * @param  AttributeItem  $attributeItem
     * @return mixed
     */
    public function update(User $user, AttributeItem $attributeItem)
    {
        return $user->canUser('attribute_item_update');
    }

    /**
     * Determine whether the user can destroy the attribute item.
     *
     * @param  User  $user
     * @param  AttributeItem  $attributeItem
     * @return mixed
     */
    public function destroy(User $user, AttributeItem $attributeItem)
    {
        return $user->canUser('attribute_item_destroy');
    }

}
