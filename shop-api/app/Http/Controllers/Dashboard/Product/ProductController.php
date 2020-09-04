<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Controllers\Controller;
use App\Services\ProductService;

class ProductController extends Controller
{
    /** @var ProductService $service */
    protected $service;

    /**
     * ProductListController constructor.
     *
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }
}
