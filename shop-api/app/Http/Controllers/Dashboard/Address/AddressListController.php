<?php

namespace App\Http\Controllers\Dashboard\Address;

use App\Http\Requests\Dashboard\Address\AddressListRequest;
use App\Http\Resources\Dashboard\Address\AddressListResource;
use App\Models\User;

class AddressListController extends AddressController
{
    /**
     * @param  AddressListRequest  $request
     * @param  User                $user
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(AddressListRequest $request, User $user)
    {
        return AddressListResource::collection($this->service->setUser($user)->getAddresses())
                                  ->additional($this->service->userAddressCount());
    }
}
