<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository extends Address
{
    protected $table = 'addresses';

    /**
     * @param  int  $user_id
     *
     * @return AddressRepository[]
     */
    public function getUserAddress(int $user_id)
    {
        return self::where('user_id', $user_id)->get();
    }
}
