<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Requests\Dashboard\Product\ProductDestroyRequest;
use App\Models\Product;

class ProductDestroyController extends ProductController
{
    /**
     * @param ProductDestroyRequest $request
     * @param Product               $product
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function __invoke(ProductDestroyRequest $request, Product $product)
    {
        return $product;

        $this->service->setProduct($product)->destroy();

        return $this->success(trans('messages.product.api_destroy'));
    }
}
