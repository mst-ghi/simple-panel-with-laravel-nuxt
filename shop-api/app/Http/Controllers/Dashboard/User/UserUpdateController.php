<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Requests\Dashboard\User\UserUpdateRequest;
use App\Models\User;

class UserUpdateController extends UserController
{
    /**
     * @param  UserUpdateRequest  $request
     * @param  User               $user
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(UserUpdateRequest $request, User $user)
    {
        $this->service
            ->setUser($user)
            ->update($request->only(['name', 'family', 'mobile', 'email']));

        return $this->success(trans('messages.user.api_updated'));
    }
}
