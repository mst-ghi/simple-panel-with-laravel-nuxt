<?php

namespace App\Http\Controllers\Dashboard\Category;

use App\Http\Requests\Dashboard\Category\CategoryDestroyRequest;
use App\Models\Category;

class CategoryDestroyController extends CategoryController
{
    /**
     * @param  CategoryDestroyRequest  $request
     * @param  Category                $category
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function __invoke(CategoryDestroyRequest $request, Category $category)
    {
        if (blank($category->categories)){
            $this->service->setCategory($category)->destroy();

            return $this->success(trans('messages.category.api_destroy'));
        }
        return $this->error(trans('messages.category.api_destroy_not'));
    }
}
