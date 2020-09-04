<?php

namespace App\Http\Controllers\Dashboard\Role;

use App\Http\Requests\Dashboard\Role\RoleUpdateRequest;
use App\Http\Resources\Dashboard\Role\RoleShowResource;
use App\Models\Role;

class RoleUpdateController extends RoleController
{
    /**
     * @param  RoleUpdateRequest  $request
     * @param  Role               $role
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(RoleUpdateRequest $request, Role $role)
    {
        $data = $request->only(['label', 'title', 'description']);

        $this->service->setRole($role)->update($data);

        return $this->success(
            trans('messages.role.api_update'),
            new RoleShowResource($this->service->getRole())
        );
    }
}
