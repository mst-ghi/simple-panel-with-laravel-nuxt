<?php

namespace App\Http\Controllers\Dashboard\Banner;

use App\Http\Controllers\Controller;
use App\Services\BannerService;

class BannerController extends Controller
{
    /**
     * @var BannerService $service
     */
    protected $service;

    /**
     * BannerController constructor.
     *
     * @param  BannerService  $service
     */
    public function __construct(BannerService $service)
    {
        $this->service = $service;
    }
}
