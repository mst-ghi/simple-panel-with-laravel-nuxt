<?php

namespace App\Http\Controllers\Dashboard\Attribute\Group;

use App\Http\Requests\Dashboard\Attribute\Group\AttributeGroupListRequest;
use App\Http\Resources\Dashboard\Attribute\Group\AttributeGroupListResource;
use App\Http\Resources\Dashboard\Attribute\Group\AttributeGroupShortListResource;

class AttributeGroupListController extends AttributeGroupController
{
    /** @var int $per $per_pagePage */
    protected $per_page;

    /**
     * @param AttributeGroupListRequest $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(AttributeGroupListRequest $request)
    {
        $this->handleQueryParam($request);

        if (isset($this->per_page))
            return AttributeGroupListResource::collection($this->service->getList($this->per_page))
                                             ->additional($this->service->getCount());

        return AttributeGroupShortListResource::collection($this->service->getList());
    }

    /**
     * @param $request
     */
    public function handleQueryParam($request)
    {
        $this->per_page = $request->get('per_page') ?? null;
    }
}
