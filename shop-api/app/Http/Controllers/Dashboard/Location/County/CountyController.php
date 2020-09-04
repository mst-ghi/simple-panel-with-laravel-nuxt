<?php

namespace App\Http\Controllers\Dashboard\Location\County;

use App\Http\Controllers\Controller;
use App\Services\CountyService;

class CountyController extends Controller
{
    /** @var CountyService $service */
    protected $service;

    /**
     * CountyStoreController constructor.
     *
     * @param  CountyService  $service
     */
    public function __construct(CountyService $service)
    {
        $this->service = $service;
    }
}
