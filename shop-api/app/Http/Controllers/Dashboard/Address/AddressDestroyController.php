<?php

namespace App\Http\Controllers\Dashboard\Address;


use App\Http\Requests\Dashboard\Address\AddressDestroyRequest;
use App\Models\Address;
use App\Models\User;

class AddressDestroyController extends AddressController
{
    /**
     * @param  AddressDestroyRequest  $request
     * @param  User                   $user
     * @param  Address                $address
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \App\Exceptions\Address\AddressOwnedUserException
     */
    public function __invoke(AddressDestroyRequest $request, User $user, Address $address)
    {
        $this->service->setUser($user)->setAddress($address)->destroy();

        return $this->success(trans('messages.address.api_destroy'));
    }
}
