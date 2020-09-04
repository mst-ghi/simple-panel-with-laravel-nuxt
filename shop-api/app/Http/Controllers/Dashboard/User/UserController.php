<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Services\UserService;

class UserController extends Controller
{
    /** @var UserService $service */
    protected $service;

    /**
     * UserDestroyController constructor.
     *
     * @param  UserService  $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

}
