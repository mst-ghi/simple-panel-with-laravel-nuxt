<?php

namespace App\Http\Controllers\Dashboard\Attribute\Attribute;

use App\Http\Requests\Dashboard\Attribute\Attribute\AttributeDestroyRequest;
use App\Models\Attribute;

class AttributeDestroyController extends AttributeController
{
    /**
     * @param  AttributeDestroyRequest  $request
     * @param  Attribute                $attribute
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function __invoke(AttributeDestroyRequest $request, Attribute $attribute)
    {
        $this->service->setAttribute($attribute)->destroy();

        return $this->success(trans('messages.attribute.api_destroy'));
    }
}
