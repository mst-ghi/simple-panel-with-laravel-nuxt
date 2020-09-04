<?php

namespace App\Http\Controllers\Dashboard\Location\County;

use App\Http\Requests\Dashboard\Location\County\CountyListRequest;
use App\Http\Resources\Dashboard\Location\County\CountyListResource;
use App\Http\Resources\Dashboard\Location\County\CountyWithoutPerPageResource;

class CountyListController extends CountyController
{
    /** @var int $per_page */
    protected $per_page;

    /** @var int $province_id */
    protected $province_id;

    /**
     * @param  CountyListRequest  $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(CountyListRequest $request)
    {
        $this->handleQueryParam($request);

        if (isset($this->per_page)){
            return CountyListResource::collection($this->service->countyList($this->per_page))->additional($this->service->getCount());
        }

        return CountyWithoutPerPageResource::collection($this->service->countyList($this->per_page, $this->province_id));
    }

    /**
     * @param $request
     */
    protected function handleQueryParam($request)
    {
        $this->per_page = $request->get('per_page') ?? null;
        $this->province_id = $request->get('province_id') ?? null;
    }
}
