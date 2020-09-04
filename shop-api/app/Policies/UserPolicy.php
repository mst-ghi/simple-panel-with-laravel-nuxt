<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list models.
     *
     * @param  User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->canUser('user_list');
    }

    /**
     * Determine whether the user can showInfo model.
     *
     * @param  User  $user
     * @return mixed
     */
    public function showInfo(User $user)
    {
        return $user->canUser('user_show_info');
    }

    /**
     * Determine whether the user can store models.
     *
     * @param  User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->canUser('user_store');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->canUser('user_update');
    }

    /**
     * Determine whether the user can updateInfo the model.
     *
     * @param  User  $user
     * @param  User  $model
     * @return mixed
     */
    public function updateInfo(User $user, User $model)
    {
        return $user->canUser('user_update_info');
    }

    /**
     * Determine whether the user can updateRole the model.
     *
     * @param  User  $user
     * @param  User  $model
     * @return mixed
     */
    public function updateRole(User $user, User $model)
    {
        return $user->canUser('user_update_role');
    }

    /**
     * Determine whether the user can destroy the model.
     *
     * @param  User  $user
     * @param  User  $model
     * @return mixed
     */
    public function destroy(User $user, User $model)
    {
        return $user->canUser('user_destroy');
    }
}
