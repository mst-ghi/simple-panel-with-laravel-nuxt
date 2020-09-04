<?php

namespace App\Http\Controllers\Dashboard\Location\Province;

use App\Http\Requests\Dashboard\Location\Province\ProvinceListRequest;
use App\Http\Resources\Dashboard\Location\Province\ProvinceListResource;
use App\Http\Resources\Dashboard\Location\Province\ProvinceWithoutPerPageResource;

class ProvinceListController extends ProvinceController
{
    /** @var int $per_page */
    protected $per_page;

    /**
     * @param  ProvinceListRequest  $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(ProvinceListRequest $request)
    {
        $this->handleQueryParam($request);

        if (isset($this->per_page)) {
            return ProvinceListResource::collection($this->service->provinceList($this->per_page))
                                       ->additional($this->service->getCount());
        }

        return ProvinceWithoutPerPageResource::collection($this->service->provinceList($this->per_page));
    }

    /**
     * @param $request
     */
    protected function handleQueryParam($request)
    {
        $this->per_page = $request->get('per_page') ?? null;
    }
}
