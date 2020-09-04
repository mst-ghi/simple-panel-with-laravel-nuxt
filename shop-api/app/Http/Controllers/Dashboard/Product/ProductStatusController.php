<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Requests\Dashboard\Product\ProductStatusRequest;
use App\Models\Product;

class ProductStatusController extends ProductController
{
    /** @var boolean $flag */
    protected $flag;

    /**
     * @param  ProductStatusRequest  $request
     * @param  Product               $product
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(ProductStatusRequest $request, Product $product)
    {
        $this->handleQueryParam($request);

        if (isset($this->flag)) $this->service->setProduct($product)->changeStatus($this->flag);

        return $this->success(trans('messages.product.api_status'));
    }

    /**
     * @param $request
     */
    protected function handleQueryParam($request)
    {
        switch ($request->get('flag')){
            case '1':
                $this->flag = true;
                break;
            case '0':
                $this->flag = false;
                break;
        }
    }
}
