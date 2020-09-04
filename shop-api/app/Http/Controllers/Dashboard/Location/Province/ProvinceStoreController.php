<?php

namespace App\Http\Controllers\Dashboard\Location\Province;

use App\Http\Requests\Dashboard\Location\Province\ProvinceStoreRequest;
use App\Http\Resources\Dashboard\Location\Province\ProvinceShowResource;

class ProvinceStoreController extends ProvinceController
{
    /**
     * @param  ProvinceStoreRequest  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(ProvinceStoreRequest $request)
    {
        $data = $request->only(['name', 'en_name', 'area_code', 'latitude', 'longitude']);

        return $this->success(trans('messages.province.api_create'), new ProvinceShowResource($this->service->create($data)));
    }
}
