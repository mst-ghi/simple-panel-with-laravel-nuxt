<?php

namespace App\Http\Controllers\Dashboard\Location\City;

use App\Http\Requests\Dashboard\Location\City\CityDestroyRequest;
use App\Models\City;

class CityDestroyController extends CityController
{
    /**
     * @param  CityDestroyRequest  $request
     * @param  City                $city
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function __invoke(CityDestroyRequest $request, City $city)
    {
        $this->service->setCity($city)->destroy();

        return $this->success(trans('messages.city.api_destroy'));
    }
}
