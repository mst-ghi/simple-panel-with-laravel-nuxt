<?php

namespace App\Http\Controllers\Dashboard\Attribute\Item;

use App\Http\Requests\Dashboard\Attribute\Item\AttributeItemListRequest;
use App\Http\Resources\Dashboard\Attribute\Attribute\AttributeShortListResource;
use App\Http\Resources\Dashboard\Attribute\Item\AttributeItemListResource;

class AttributeItemListController extends AttributeItemController
{
    /** @var int $per_page */
    protected $per_page;

    /**
     * @param AttributeItemListRequest $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(AttributeItemListRequest $request)
    {
        $this->handleQueryParam($request);

        if ($this->per_page)
            return AttributeItemListResource::collection($this->service->getList($this->per_page))
                ->additional($this->service->getCount());

        return  AttributeShortListResource::collection($this->service->getList());
    }

    /**
     * @param $request
     */
    public function handleQueryParam($request)
    {
        $this->per_page = $request->get('per_page') ?? null;
    }
}
