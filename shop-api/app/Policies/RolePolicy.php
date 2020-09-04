<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the role.
     *
     * @param  User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->canUser('role_list');
    }

    /**
     * Determine whether the user can store roles.
     *
     * @param  User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->canUser('role_store');
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  User  $user
     * @param  Role  $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        return $user->canUser('role_update');
    }

    /**
     * Determine whether the user can destroy the role.
     *
     * @param  User  $user
     * @param  Role  $role
     * @return mixed
     */
    public function destroy(User $user, Role $role)
    {
        return $user->canUser('role_destroy');
    }

    /**
     * Determine whether the user can showPermissions the role.
     *
     * @param  User  $user
     * @param  Role  $role
     * @return mixed
     */
    public function showPermissions(User $user, Role $role)
    {
        return $user->canUser('role_show_permissions');
    }

    /**
     * Determine whether the user can updatePermissions the role.
     *
     * @param  User  $user
     * @param  Role  $role
     * @return mixed
     */
    public function updatePermissions(User $user, Role $role)
    {
        return $user->canUser('role_update_permissions');
    }
}
