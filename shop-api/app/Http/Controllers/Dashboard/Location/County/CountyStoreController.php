<?php

namespace App\Http\Controllers\Dashboard\Location\County;

use App\Http\Requests\Dashboard\Location\County\CountyStoreRequest;
use App\Http\Resources\Dashboard\Location\County\CountyShowResource;

class CountyStoreController extends CountyController
{
    /**
     * @param  CountyStoreRequest  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(CountyStoreRequest $request)
    {
        $data = $request->only(['province_id', 'en_name', 'name', 'latitude', 'longitude']);

        return $this->success(
            trans('messages.county.api_create'),
            new CountyShowResource($this->service->create($data))
        );
    }
}
