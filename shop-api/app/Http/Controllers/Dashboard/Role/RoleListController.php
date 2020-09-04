<?php

namespace App\Http\Controllers\Dashboard\Role;

use App\Http\Requests\Dashboard\Role\RoleListRequest;
use App\Http\Resources\Dashboard\Role\RoleListResource;

class RoleListController extends RoleController
{
    /**
     * @param  RoleListRequest  $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(RoleListRequest $request)
    {
        return RoleListResource::collection($this->service->getRoleList())->additional([
            'total'             => $this->service->getRoleCount(),
            'total_permissions' => $this->service->getPermissionsCount(),
        ]);
    }
}
