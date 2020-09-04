<?php

namespace App\Http\Controllers\Dashboard\Location\Province;

use App\Http\Controllers\Controller;
use App\Services\ProvinceService;

class ProvinceController extends Controller
{
    /** @var ProvinceService $service */
    protected $service;

    /**
     * ProvinceListController constructor.
     *
     * @param  ProvinceService  $service
     */
    public function __construct(ProvinceService $service)
    {
        $this->service = $service;
    }
}
