<?php

namespace App\Http\Controllers\Dashboard\Role;

use App\Http\Requests\Dashboard\Role\RoleDestroyRequest;
use App\Models\Role;

class RoleDestroyController extends RoleController
{
    /**
     * @param  RoleDestroyRequest  $request
     * @param  Role                $role
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(RoleDestroyRequest $request, Role $role)
    {
        /** @var boolean $result */
        $result = $this->service->setRole($role)->destroy();

        if ($result)
            return $this->success(trans('messages.role.api_destroy'));

        return $this->error(trans('messages.role.api_destroy_not'));
    }
}
