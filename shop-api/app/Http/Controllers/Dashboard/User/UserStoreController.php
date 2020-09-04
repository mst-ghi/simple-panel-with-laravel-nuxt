<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Requests\Dashboard\User\UserStoreRequest;
use App\Http\Resources\Dashboard\Auth\UserInfoResource;

class UserStoreController extends UserController
{
    /**
     * @param  UserStoreRequest  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(UserStoreRequest $request)
    {
        $data = $request->only(['username', 'name', 'family', 'mobile', 'email']);

        $user = $this->service->create($data, $request->password);

        return $this->success(trans('messages.user.api_store'), new UserInfoResource($user));
    }
}
