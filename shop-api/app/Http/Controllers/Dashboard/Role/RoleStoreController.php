<?php

namespace App\Http\Controllers\Dashboard\Role;

use App\Http\Requests\Dashboard\Role\RoleStoreRequest;
use App\Http\Resources\Dashboard\Role\RoleShowResource;

class RoleStoreController extends RoleController
{
    /**
     * @param  RoleStoreRequest  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(RoleStoreRequest $request)
    {
        $data = $request->only(['label', 'title', 'description']);

        $this->service->store($data);

        return $this->success(
            trans('messages.role.api_create'),
            new RoleShowResource($this->service->getRole())
        );
    }
}
