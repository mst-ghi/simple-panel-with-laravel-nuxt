<?php

namespace App\Http\Controllers\Dashboard\Location\County;

use App\Http\Requests\Dashboard\Location\County\CountyUpdateRequest;
use App\Http\Resources\Dashboard\Location\County\CountyShowResource;
use App\Models\County;

class CountyUpdateController extends CountyController
{
    /**
     * @param  CountyUpdateRequest  $request
     * @param  County               $county
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(CountyUpdateRequest $request, County $county)
    {
        $data = $request->only(['province_id', 'en_name', 'name', 'latitude', 'longitude']);

        $this->service->setCounty($county)->update($data);

        return $this->success(
            trans('messages.county.api_update'),
            new CountyShowResource($this->service->getCounty())
        );
    }
}
