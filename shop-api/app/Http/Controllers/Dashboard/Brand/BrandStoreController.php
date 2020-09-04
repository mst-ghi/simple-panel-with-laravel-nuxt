<?php

namespace App\Http\Controllers\Dashboard\Brand;

use App\Http\Requests\Dashboard\Brand\BrandStoreRequest;
use App\Http\Resources\Dashboard\Brand\BrandShowResource;

class BrandStoreController extends BrandController
{
    /**
     * @param  BrandStoreRequest  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(BrandStoreRequest $request)
    {
        $data = $request->only(['slug', 'title']);

        return $this->success(
            trans('messages.brand.api_create'),
            new BrandShowResource($this->service->create($data, $request->photo ?? null))
        );
    }
}
