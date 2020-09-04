<?php

namespace App\Http\Controllers\Dashboard\Category;

use App\Http\Requests\Dashboard\Category\CategoryStoreRequest;
use App\Http\Resources\Dashboard\Category\CategoryShowResource;

class CategoryStoreController extends CategoryController
{
    /**
     * @param  CategoryStoreRequest  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(CategoryStoreRequest $request)
    {
        $data = $request->only(['parent_id', 'slug', 'title']);

        return $this->success(
            trans('messages.category.api_create'),
            new CategoryShowResource($this->service->create($data))
        );
    }
}
