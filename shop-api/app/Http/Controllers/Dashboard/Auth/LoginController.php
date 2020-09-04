<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Requests\Dashboard\Auth\LoginRequest;

class LoginController extends AuthController
{
    /**
     * @param LoginRequest $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \App\Exceptions\User\UserInvalidPasswordException
     * @throws \App\Exceptions\User\UserNotFoundException
     * @throws \App\Exceptions\User\UserStatusException
     */
    public function __invoke(LoginRequest $request)
    {
        $this->service->setInfo($request->username, $request->password);

        return $this->makeResponse();
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \App\Exceptions\User\UserInvalidPasswordException
     * @throws \App\Exceptions\User\UserNotFoundException
     * @throws \App\Exceptions\User\UserStatusException
     */
    private function makeResponse(){
        return response([
            'success' => true,
            'message' => 'ورود با موفقیت انجام شد',
            'token'   => $this->service->login(),
        ], 200);
    }
}
