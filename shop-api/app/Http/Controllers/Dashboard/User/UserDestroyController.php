<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Requests\Dashboard\User\UserDestroyRequest;
use App\Models\User;

class UserDestroyController extends UserController
{
    /**
     * @param  UserDestroyRequest  $request
     * @param  User                $user
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(UserDestroyRequest $request, User $user)
    {
//        $this->service->setUser($user)->destroyUser();

        return $this->success(trans('messages.user.api_destroy'));
    }
}
