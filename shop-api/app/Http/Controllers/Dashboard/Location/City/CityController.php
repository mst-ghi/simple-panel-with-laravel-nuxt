<?php

namespace App\Http\Controllers\Dashboard\Location\City;

use App\Http\Controllers\Controller;
use App\Services\CityService;

class CityController extends Controller
{
    /** @var CityService $service */
    protected $service;

    /**
     * CityListController constructor.
     *
     * @param  CityService  $service
     */
    public function __construct(CityService $service)
    {
        $this->service = $service;
    }
}
