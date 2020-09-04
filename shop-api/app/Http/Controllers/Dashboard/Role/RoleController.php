<?php

namespace App\Http\Controllers\Dashboard\Role;

use App\Http\Controllers\Controller;
use App\Services\RoleService;

class RoleController extends Controller
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
}
