<?php

namespace App\Http\Controllers\Dashboard\Attribute\Attribute;

use App\Http\Requests\Dashboard\Attribute\Attribute\AttributeUpdateRequest;
use App\Http\Resources\Dashboard\Attribute\Attribute\AttributeShowResource;
use App\Models\Attribute;

class AttributeUpdateController extends AttributeController
{
    /**
     * @param  AttributeUpdateRequest  $request
     * @param  Attribute               $attribute
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(AttributeUpdateRequest $request, Attribute $attribute)
    {
        $data = $request->only(['attribute_group_id', 'type', 'title', 'slug', 'status']);

        $this->service->setAttribute($attribute)->update($data);

        return $this->success(
            trans('messages.attribute.api_update'),
            new AttributeShowResource($this->service->getAttribute())
        );
    }
}
