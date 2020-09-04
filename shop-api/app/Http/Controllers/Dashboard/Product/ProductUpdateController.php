<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Requests\Dashboard\Product\ProductUpdateRequest;
use App\Http\Resources\Dashboard\Product\ProductShowResource;
use App\Models\Product;

class ProductUpdateController extends ProductController
{
    /**
     * @param  ProductUpdateRequest  $request
     * @param  Product               $product
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function __invoke(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->only([
            'brand_id',
            'title_fa',
            'title_en',
            'slug',
            'price',
            'price_old',
            'short_desc',
            'long_desc',
            'status'
        ]);

        $this->service->setProduct($product)
                      ->setCategoryIds(array_unique($request->category_ids))
                      ->setItemIds(array_unique($request->item_ids))
                      ->update($data, $request->photo);

        return $this->success(
            trans('messages.product.api_update'),
            new ProductShowResource($this->service->getProduct())
        );
    }
}
