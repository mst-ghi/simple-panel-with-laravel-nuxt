<?php

namespace App\Http\Controllers\Dashboard\Attribute\Group;

use App\Http\Requests\Dashboard\Attribute\Group\AttributeGroupStoreRequest;
use App\Http\Resources\Dashboard\Attribute\Group\AttributeGroupShowResource;

class AttributeGroupStoreController extends AttributeGroupController
{
    /**
     * @param AttributeGroupStoreRequest $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(AttributeGroupStoreRequest $request)
    {
        $data = $request->only(['category_id', 'title', 'status']);

        return $this->success(
            trans('messages.attributeGroup.api_create'),
            new AttributeGroupShowResource($this->service->create($data))
        );
    }
}
