<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list the permission.
     *
     * @param  User  $user
     * @param  Permission  $permission
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->canUser('permission_list');
    }
}
