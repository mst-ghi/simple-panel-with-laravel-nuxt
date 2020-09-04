<?php

namespace App\Http\Controllers\Dashboard\Location\City;

use App\Http\Requests\Dashboard\Location\City\CityListRequest;
use App\Http\Resources\Dashboard\Location\City\CityListResource;
use App\Http\Resources\Dashboard\Location\City\CityShortListResource;

class CityListController extends CityController
{
    /** @var int $per_page */
    protected $per_page;

    /** @var int $county_id */
    protected $county_id;

    /**
     * @param  CityListRequest  $request
     *
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(CityListRequest $request)
    {
        $this->handleQueryParam($request);

        if ($this->per_page)
            return CityListResource::collection($this->service->cityList($this->per_page))
                                   ->additional($this->service->getCount());

        if (!$this->county_id) return [];

        return CityShortListResource::collection($this->service->cityShortList($this->county_id));
    }

    /**
     * @param $request
     */
    protected function handleQueryParam($request)
    {
        $this->per_page = $request->get('per_page') ?? null;
        $this->county_id = $request->get('county_id') ?? null;
    }
}
