<?php

namespace App\Http\Controllers\Dashboard\Location\Province;

use App\Http\Requests\Dashboard\Location\Province\ProvinceDestroyRequest;
use App\Models\Province;

class ProvinceDestroyController extends ProvinceController
{
    /**
     * @param  ProvinceDestroyRequest  $request
     * @param  Province                $province
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function __invoke(ProvinceDestroyRequest $request, Province $province)
    {
        $this->service->setProvince($province)->destroy();

        return $this->success(trans('messages.province.api_destroy'));
    }
}
