<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\LogoutRequest;
use App\Models\User;
use App\Services\AuthService;

class LogoutController extends AuthController
{
    /**
     * @param LogoutRequest $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function __invoke(LogoutRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $this->service->setUser($user)->logout();

        return $this->success('خروج با موفقیت ارسال شد');
    }
}
