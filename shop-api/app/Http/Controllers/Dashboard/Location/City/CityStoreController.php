<?php

namespace App\Http\Controllers\Dashboard\Location\City;

use App\Http\Requests\Dashboard\Location\City\CityStoreRequest;
use App\Http\Resources\Dashboard\Location\County\CountyShowResource;

class CityStoreController extends CityController
{
    /**
     * @param  CityStoreRequest  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(CityStoreRequest $request)
    {
        $data = $request->only(['province_id', 'county_id', 'en_name', 'name', 'latitude', 'longitude']);

        return $this->success(
            trans('messages.city.api_create'),
            new CountyShowResource($this->service->create($data))
        );
    }
}
