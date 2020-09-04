<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Requests\Dashboard\Product\ProductListRequest;
use App\Http\Resources\Dashboard\Product\ProductListResource;

class ProductListController extends ProductController
{
    /** @var int $per_page */
    protected $per_page;

    /**
     * @param  ProductListRequest  $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(ProductListRequest $request)
    {
        $this->handleQueryParam($request);

        return ProductListResource::collection($this->service->getFilteredListProducts($this->per_page))
                                  ->additional($this->service->getCount());
    }

    /**
     * @param $request
     */
    protected function handleQueryParam($request)
    {
        $this->per_page = $request->get('per_page') ?? null;
    }
}
