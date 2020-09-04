<?php

namespace App\Http\Controllers\Dashboard\Role;

use App\Http\Requests\Dashboard\Role\RolePermissionSyncRequest;
use App\Models\Role;

class RolePermissionSyncController extends RoleController
{
    /**
     * @param  RolePermissionSyncRequest  $request
     * @param  Role                       $role
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(RolePermissionSyncRequest $request, Role $role)
    {
        $this->service->setRole($role)->syncRolePermissionList(array_unique($request->permissions));

        return $this->success(trans('messages.role.api_sync'));
    }
}
