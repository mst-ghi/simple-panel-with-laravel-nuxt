<?php

namespace App\Http\Controllers\Dashboard\Address;

use App\Http\Requests\Dashboard\Address\AddressUpdateRequest;
use App\Models\Address;
use App\Models\User;

class AddressUpdateController extends AddressController
{
    /**
     * @param  AddressUpdateRequest  $request
     * @param  User                  $user
     * @param  Address               $address
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \App\Exceptions\Address\AddressOwnedUserException
     */
    public function __invoke(AddressUpdateRequest $request, User $user, Address $address)
    {
        $data = $request->only([
            'city_id',
            'mobile',
            'phone',
            'name',
            'family',
            'address',
            'postal_code',
            'latitude',
            'longitude',
            'default'
        ]);

        $this->service->setUser($user)->setAddress($address)->update($data);

        return $this->success(trans('messages.address.api_update'));
    }
}
