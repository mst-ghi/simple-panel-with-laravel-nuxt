<?php

namespace App\Http\Controllers\Dashboard\Attribute\Attribute;

use App\Http\Requests\Dashboard\Attribute\Attribute\AttributeListRequest;
use App\Http\Resources\Dashboard\Attribute\Attribute\AttributeListResource;
use App\Http\Resources\Dashboard\Attribute\Attribute\AttributeShortListResource;

class AttributeListController extends AttributeController
{
    /** @var int $per_page */
    protected $per_page;

    /**
     * @param  AttributeListRequest  $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(AttributeListRequest $request)
    {
        $this->handleQueryParam($request);

        if (isset($this->per_page))
            return AttributeListResource::collection($this->service->getList($this->per_page))
                ->additional($this->service->getCount());

        return AttributeShortListResource::collection($this->service->getList());
    }

    /**
     * @param $request
     */
    public function handleQueryParam($request)
    {
        $this->per_page = $request->get('per_page') ?? null;
    }
}
