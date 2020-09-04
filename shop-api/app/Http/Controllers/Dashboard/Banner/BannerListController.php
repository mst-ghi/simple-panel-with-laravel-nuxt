<?php

namespace App\Http\Controllers\Dashboard\Banner;

use App\Http\Requests\Dashboard\Banner\BannerListRequest;
use App\Http\Resources\Dashboard\Banner\BannerListResource;

class BannerListController extends BannerController
{
    /** @var int $per_page */
    protected $per_page;

    /**
     * @param  BannerListRequest  $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(BannerListRequest $request)
    {
        $this->handleQueryParam($request);

        return BannerListResource::collection($this->service->getList($this->per_page))
            ->additional($this->service->getCount());
    }

    /**
     * @param $request
     */
    protected function handleQueryParam($request)
    {
        $this->per_page = $request->get('per_page') ?? null;
    }
}
