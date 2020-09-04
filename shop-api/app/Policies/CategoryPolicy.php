<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categories.
     *
     * @param  User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->canUser('category_list');
    }

    /**
     * Determine whether the user can store categories.
     *
     * @param  User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->canUser('category_store');
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  User  $user
     * @param  Category  $category
     * @return mixed
     */
    public function update(User $user, Category $category)
    {
        return $user->canUser('category_update');
    }

    /**
     * Determine whether the user can destroy the category.
     *
     * @param  User  $user
     * @param  Category  $category
     * @return mixed
     */
    public function destroy(User $user, Category $category)
    {
        return $user->canUser('category_destroy');
    }
}
