<?php

namespace App\Http\Controllers\Dashboard\Role;

use App\Http\Requests\Dashboard\Role\RolePermissionListRequest;
use App\Http\Resources\Dashboard\Permission\PermissionListResource;
use App\Models\Role;

class RolePermissionListController extends RoleController
{
    /**
     * @param  RolePermissionListRequest  $request
     *
     * @param  Role                       $role
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(RolePermissionListRequest $request, Role $role)
    {
        $this->service->setRole($role);

        return PermissionListResource::collection($this->service->getRolePermissionsList());
    }
}
