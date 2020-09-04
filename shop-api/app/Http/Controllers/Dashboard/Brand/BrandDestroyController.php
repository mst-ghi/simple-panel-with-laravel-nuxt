<?php

namespace App\Http\Controllers\Dashboard\Brand;

use App\Http\Requests\Dashboard\Brand\BrandDestroyRequest;
use App\Models\Brand;

class BrandDestroyController extends BrandController
{
    /**
     * @param  BrandDestroyRequest  $request
     * @param  Brand                $brand
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function __invoke(BrandDestroyRequest $request, Brand $brand)
    {
        $this->service->setBrand($brand)->destroy();

        return $this->success(trans('messages.brand.api_destroy'));
    }
}
