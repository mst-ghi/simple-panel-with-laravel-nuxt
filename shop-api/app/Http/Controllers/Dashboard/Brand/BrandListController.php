<?php

namespace App\Http\Controllers\Dashboard\Brand;

use App\Http\Requests\Dashboard\Brand\BrandListRequest;
use App\Http\Resources\Dashboard\Brand\BrandListResource;
use App\Http\Resources\Dashboard\Brand\BrandShortListResource;

class BrandListController extends BrandController
{
    /**
     * @param  BrandListRequest  $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(BrandListRequest $request)
    {
        if (isset($request->list) && $request->list == 'short')
            return BrandShortListResource::collection($this->service->getList());

        return BrandListResource::collection($this->service->getList())->additional([
            'brand_count' => $this->service->getBrandsCount()
        ]);
    }
}
