<?php

namespace App\Http\Controllers\Dashboard\Address;

use App\Http\Controllers\Controller;
use App\Services\AddressService;

class AddressController extends Controller
{
    /** @var AddressService $service */
    protected $service;

    /**
     * AddressController constructor.
     *
     * @param  AddressService  $service
     */
    public function __construct(AddressService $service)
    {
        $this->service = $service;
    }
}
