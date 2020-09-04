<?php

namespace App\Http\Controllers\Dashboard\Location\County;

use App\Http\Requests\Dashboard\Location\County\CountyDestroyRequest;
use App\Models\County;

class CountyDestroyController extends CountyController
{
    /**
     * @param  CountyDestroyRequest  $request
     * @param  County                $county
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function __invoke(CountyDestroyRequest $request, County $county)
    {
        $this->service->setCounty($county)->destroy();

        return $this->success(trans('messages.county.api_destroy'));
    }
}
