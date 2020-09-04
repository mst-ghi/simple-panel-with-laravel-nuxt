<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Requests\Dashboard\Auth\UserInfoRequest;
use App\Http\Resources\Dashboard\Auth\UserInfoResource;
use App\Models\User;

class UserInfoController extends AuthController
{
    /**
     * @param UserInfoRequest $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(UserInfoRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();

        return $this->success('اطلاعات شما با موفقیت ارسال شد', new UserInfoResource($user));
    }
}
