<?php

namespace App\Http\Controllers\Dashboard\Attribute\Item;

use App\Http\Requests\Dashboard\Attribute\Item\AttributeItemUpdateRequest;
use App\Http\Resources\Dashboard\Attribute\Item\AttributeItemShowResource;
use App\Models\AttributeItem;

class AttributeItemUpdateController extends AttributeItemController
{
    /**
     * @param AttributeItemUpdateRequest $request
     * @param AttributeItem              $item
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(AttributeItemUpdateRequest $request, AttributeItem $item)
    {
        $data = $request->only(['attribute_id', 'title', 'status']);

        $this->service->setAttributeItem($item)->update($data);

        return $this->success(
            trans('messages.attributeItem.api_update'),
            new AttributeItemShowResource($this->service->getAttributeItem())
        );
    }
}
