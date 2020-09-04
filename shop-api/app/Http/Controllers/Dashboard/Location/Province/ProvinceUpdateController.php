<?php

namespace App\Http\Controllers\Dashboard\Location\Province;

use App\Http\Requests\Dashboard\Location\Province\ProvinceUpdateRequest;
use App\Http\Resources\Dashboard\Location\Province\ProvinceShowResource;
use App\Models\Province;

class ProvinceUpdateController extends ProvinceController
{
    /**
     * @param  ProvinceUpdateRequest  $request
     * @param  Province               $province
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(ProvinceUpdateRequest $request, Province $province)
    {
        $data = $request->only(['name', 'en_name', 'area_code', 'latitude', 'longitude']);

        $this->service->setProvince($province)->update($data);

        return $this->success(trans('messages.province.api_update'), new ProvinceShowResource($this->service->getProvince()));
    }
}
