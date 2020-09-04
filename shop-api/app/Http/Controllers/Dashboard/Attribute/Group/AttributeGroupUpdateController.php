<?php

namespace App\Http\Controllers\Dashboard\Attribute\Group;

use App\Http\Requests\Dashboard\Attribute\Group\AttributeGroupUpdateRequest;
use App\Http\Resources\Dashboard\Attribute\Group\AttributeGroupShowResource;
use App\Models\AttributeGroup;

class AttributeGroupUpdateController extends AttributeGroupController
{
    /**
     * @param AttributeGroupUpdateRequest $request
     * @param AttributeGroup              $group
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(AttributeGroupUpdateRequest $request, AttributeGroup $group)
    {
        $data = $request->only(['category_id', 'title', 'status']);

        $this->service->setAttributeGroup($group);

        $this->service->update($data);

        return $this->success(
            trans('messages.attributeGroup.api_update'),
            new AttributeGroupShowResource($this->service->getAttributeGroup())
        );
    }
}
