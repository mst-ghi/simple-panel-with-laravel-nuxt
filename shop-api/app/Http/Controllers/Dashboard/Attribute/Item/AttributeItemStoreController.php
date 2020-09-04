<?php

namespace App\Http\Controllers\Dashboard\Attribute\Item;

use App\Http\Requests\Dashboard\Attribute\Item\AttributeItemStoreRequest;
use App\Http\Resources\Dashboard\Attribute\Item\AttributeItemShowResource;

class AttributeItemStoreController extends AttributeItemController
{
    /**
     * @param AttributeItemStoreRequest $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(AttributeItemStoreRequest $request)
    {
        $data = $request->only(['attribute_id', 'title', 'status']);

        return $this->success(
            trans('messages.attributeItem.api_create'),
            new AttributeItemShowResource($this->service->create($data))
        );
    }
}
