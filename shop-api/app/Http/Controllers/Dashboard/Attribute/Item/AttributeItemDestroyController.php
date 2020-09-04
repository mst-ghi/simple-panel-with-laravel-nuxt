<?php

namespace App\Http\Controllers\Dashboard\Attribute\Item;

use App\Http\Requests\Dashboard\Attribute\Item\AttributeItemDestroyRequest;
use App\Models\AttributeItem;

class AttributeItemDestroyController extends AttributeItemController
{
    /**
     * @param AttributeItemDestroyRequest $request
     * @param AttributeItem               $item
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function __invoke(AttributeItemDestroyRequest $request, AttributeItem $item)
    {
        $this->service->setAttributeItem($item)->destroy();

        return $this->success(trans('messages.attributeItem.api_destroy'));
    }
}
