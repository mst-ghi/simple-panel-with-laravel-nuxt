<?php

namespace App\Http\Controllers\Dashboard\Product;


use App\Http\Requests\Dashboard\Product\ProductShowRequest;
use App\Http\Resources\Dashboard\Product\ProductShowResource;
use App\Models\Product;

class ProductShowController extends ProductController
{
    /**
     * @param  ProductShowRequest  $request
     * @param  Product             $product
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(ProductShowRequest $request, Product $product)
    {
        return $this->success(
            trans('messages.product.api_create'),
            new ProductShowResource($product)
        );
    }
}
