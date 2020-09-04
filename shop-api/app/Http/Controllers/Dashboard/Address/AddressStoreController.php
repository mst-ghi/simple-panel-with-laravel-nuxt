<?php

namespace App\Http\Controllers\Dashboard\Address;

use App\Http\Requests\Dashboard\Address\AddressStoreRequest;
use App\Http\Resources\Dashboard\Address\AddressShowResource;
use App\Models\User;

class AddressStoreController extends AddressController
{
    /**
     * @param  AddressStoreRequest  $request
     * @param  User                 $user
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(AddressStoreRequest $request, User $user)
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

        return $this->success(
            trans('messages.address.api_create'),
            new AddressShowResource($this->service->setUser($user)->storeNew($data))
        );
    }
}
