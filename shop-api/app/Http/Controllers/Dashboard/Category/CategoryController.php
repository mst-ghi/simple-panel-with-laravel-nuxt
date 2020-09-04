<?php

namespace App\Http\Controllers\Dashboard\Category;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    /** @var CategoryService $service */
    protected $service;

    /**
     * CategoryListController constructor.
     *
     * @param  CategoryService  $service
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }
}
