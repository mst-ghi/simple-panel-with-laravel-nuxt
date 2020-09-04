<?php

namespace App\Services;

use App\Exceptions\Address\AddressOwnedUserException;
use App\Models\Address;
use App\Models\User;
use App\Repositories\AddressRepository;

class AddressService
{
    /** @var AddressRepository $repository */
    protected $repository;

    /** @var User $user */
    protected $user;

    /** @var Address $address */
    protected $address;

    /**
     * AddressService constructor.
     *
     * @param  AddressRepository  $repository
     */
    public function __construct(AddressRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Address[]
     */
    public function getAddresses()
    {
        return $this->user->addresses;
    }

    /**
     * @param  array  $data
     *
     * @return Address|\Illuminate\Database\Eloquent\Model
     */
    public function storeNew(array $data)
    {
        if (isset($data['default']) && $data['default'] == true) $this->clearDefaults();

        return $this->user->addresses()->create($data);
    }

    /**
     * @param  array  $data
     *
     * @return bool
     * @throws AddressOwnedUserException
     */
    public function update(array $data)
    {
        $this->ownedUser();

        if (isset($data['default']) && $data['default'] == true) $this->clearDefaults();

        return $this->address->update($data);
    }

    /**
     * clear address default
     */
    public function clearDefaults()
    {
        $this->user->addresses()->update(['default' => false]);
    }

    /**
     * @throws AddressOwnedUserException
     * @throws \Exception
     */
    public function destroy()
    {
        $this->ownedUser();
        $this->address->delete();
    }

    /**
     * @throws AddressOwnedUserException
     */
    public function ownedUser()
    {
        if ($this->user->id != $this->address->user_id)
            throw new AddressOwnedUserException();
    }

    /**
     * @return array
     */
    public function userAddressCount()
    {
        return [
            'address_count' => $this->user->addresses()->count()
        ];
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param  User  $user
     *
     * @return AddressService
     */
    public function setUser(User $user): AddressService
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param  Address  $address
     *
     * @return AddressService
     */
    public function setAddress(Address $address): AddressService
    {
        $this->address = $address;
        return $this;
    }

}
