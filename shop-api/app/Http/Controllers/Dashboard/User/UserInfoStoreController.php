<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Requests\Dashboard\User\UserInfoStoreRequest;
use App\Http\Resources\Dashboard\User\UserInfoResource;
use App\Models\User;

class UserInfoStoreController extends UserController
{
    /**
     * @param  UserInfoStoreRequest  $request
     * @param  User                  $user
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(UserInfoStoreRequest $request, User $user)
    {
        $data = $request->only(['name','family', 'mobile', 'email']);

        $this->service->setUser($user)->update($data, $request->password ?? null);

        return $this->success(trans('messages.user.api_updated'), new UserInfoResource($this->service->getUser()));
    }
}
