<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Requests\Dashboard\User\UserInfoShowRequest;
use App\Http\Resources\Dashboard\User\UserInfoResource;
use App\Models\User;

class UserInfoShowController extends UserController
{
    /**
     * @param  UserInfoShowRequest  $request
     * @param  User                 $user
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(UserInfoShowRequest $request, User $user)
    {
        return $this->success(trans('messages.user.api_info'), new UserInfoResource($user));
    }
}
