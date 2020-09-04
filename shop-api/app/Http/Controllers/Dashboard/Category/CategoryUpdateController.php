<?php

namespace App\Http\Controllers\Dashboard\Category;

use App\Http\Requests\Dashboard\Category\CategoryUpdateRequest;
use App\Http\Resources\Dashboard\Category\CategoryShowResource;
use App\Models\Category;

class CategoryUpdateController extends CategoryController
{
    /**
     * @param  CategoryUpdateRequest  $request
     * @param  Category               $category
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(CategoryUpdateRequest $request, Category $category)
    {
        $data = $request->only(['slug', 'title']);

        if (isset($request->parent_id) && $category->id != $request->parent_id)
            $data = array_merge($data, [
                'parent_id' => $request->parent_id
            ]);


        $this->service->setCategory($category)->update($data);

        return $this->success(
            trans('messages.category.api_update'),
            new CategoryShowResource($this->service->getCategory())
        );
    }
}
