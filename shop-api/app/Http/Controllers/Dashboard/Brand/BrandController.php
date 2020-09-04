<?php

namespace App\Http\Controllers\Dashboard\Brand;

use App\Http\Controllers\Controller;
use App\Services\BrandService;

class BrandController extends Controller
{
    /** @var BrandService $service */
    protected $service;

    /**
     * BrandDestroyController constructor.
     *
     * @param  BrandService  $service
     */
    public function __construct(BrandService $service)
    {
        $this->service = $service;
    }
}
