<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Requests\Dashboard\Product\ProductStoreRequest;
use App\Http\Resources\Dashboard\Product\ProductShowResource;

class ProductStoreController extends ProductController
{
    /**
     * @param  ProductStoreRequest  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function __invoke(ProductStoreRequest $request)
    {
        $data = $request->only([
            'brand_id',
            'title_fa',
            'title_en',
            'slug',
            'price',
            'short_desc',
            'long_desc',
            'status'
        ]);

        $this->service->setCategoryIds(array_unique($request->category_ids))
                      ->setItemIds(array_unique($request->item_ids))
                      ->create($data, $request->photo);

        return $this->success(
            trans('messages.product.api_create'),
            new ProductShowResource($this->service->getProduct())
        );
    }
}
