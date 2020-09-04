<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;

class AuthController extends Controller
{
    /**
     * @var AuthService $service
     */
    protected $service;

    /**
     * LoginController constructor.
     *
     * @param AuthService $service
     */
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }
}
