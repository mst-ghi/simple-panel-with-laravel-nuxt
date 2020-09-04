<?php

namespace App\Http\Controllers\Dashboard\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Permission\PermissionListRequest;
use App\Http\Resources\Dashboard\Permission\PermissionListResource;
use App\Services\RoleService;

class PermissionListController extends Controller
{
    /** @var RoleService $service */
    protected $service;

    /**
     * RoleListController constructor.
     *
     * @param  RoleService  $service
     */
    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  PermissionListRequest  $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(PermissionListRequest $request)
    {
        return PermissionListResource::collection($this->service->getPermissionList());
    }
}
