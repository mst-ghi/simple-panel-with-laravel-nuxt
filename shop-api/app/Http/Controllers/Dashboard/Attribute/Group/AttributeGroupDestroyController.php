<?php

namespace App\Http\Controllers\Dashboard\Attribute\Group;

use App\Http\Requests\Dashboard\Attribute\Group\AttributeGroupDestroyRequest;
use App\Models\AttributeGroup;

class AttributeGroupDestroyController extends AttributeGroupController
{
    /**
     * @param AttributeGroupDestroyRequest $request
     * @param AttributeGroup               $group
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function __invoke(AttributeGroupDestroyRequest $request, AttributeGroup $group)
    {
        $this->service->setAttributeGroup($group)->destroy();

        return $this->success(trans('messages.attributeGroup.api_destroy'));
    }
}
