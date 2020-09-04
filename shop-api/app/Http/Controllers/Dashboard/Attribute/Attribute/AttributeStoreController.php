<?php

namespace App\Http\Controllers\Dashboard\Attribute\Attribute;

use App\Http\Requests\Dashboard\Attribute\Attribute\AttributeStoreRequest;
use App\Http\Resources\Dashboard\Attribute\Attribute\AttributeShowResource;

class AttributeStoreController extends AttributeController
{
    /**
     * @param  AttributeStoreRequest  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(AttributeStoreRequest $request)
    {
        $data = $request->only(['attribute_group_id', 'type', 'title', 'slug', 'status']);

        return $this->success(
            trans('messages.attribute.api_create'),
            new AttributeShowResource($this->service->create($data))
        );
    }
}
