<?php

namespace App\Http\Controllers\Dashboard\Location\City;

use App\Http\Requests\Dashboard\Location\City\CityUpdateRequest;
use App\Http\Resources\Dashboard\Location\County\CountyShowResource;
use App\Models\City;

class CityUpdateController extends CityController
{
    /**
     * @param  CityUpdateRequest  $request
     * @param  City               $city
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(CityUpdateRequest $request, City $city)
    {
        $data = $request->only(['province_id', 'county_id', 'en_name', 'name', 'latitude', 'longitude']);

        $this->service->setCity($city)->update($data);

        return $this->success(
            trans('messages.city.api_update'),
            new CountyShowResource($this->service->getCity())
        );
    }
}
