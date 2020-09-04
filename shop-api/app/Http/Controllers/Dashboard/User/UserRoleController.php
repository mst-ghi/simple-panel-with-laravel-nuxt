<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Requests\Dashboard\User\UserRoleRequest;
use App\Models\User;

class UserRoleController extends UserController
{
    /**
     * @param  UserRoleRequest  $request
     * @param  User             $user
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(UserRoleRequest $request, User $user)
    {
        $this->service->setUser($user)->userRoleSync($request->role);

        return $this->success(trans('messages.user.api_role'));
    }
}
