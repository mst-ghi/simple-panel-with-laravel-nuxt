<?php

namespace App\Http\Controllers\Dashboard\Brand;

use App\Http\Requests\Dashboard\Brand\BrandUpdateRequest;
use App\Http\Resources\Dashboard\Brand\BrandShowResource;
use App\Models\Brand;

class BrandUpdateController extends BrandController
{
    /**
     * @param  BrandUpdateRequest  $request
     * @param  Brand               $brand
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function __invoke(BrandUpdateRequest $request, Brand $brand)
    {
        $data = $request->only(['slug', 'title']);

        $this->service->setBrand($brand)->update($data, $request->photo ?? null);

        return $this->success(
            trans('messages.brand.api_update'),
            new BrandShowResource($this->service->getBrand())
        );
    }
}
