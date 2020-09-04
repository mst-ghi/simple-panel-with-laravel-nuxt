<?php

namespace App\Http\Controllers\Dashboard\Category;

use App\Http\Requests\Dashboard\Category\CategoryListRequest;
use App\Http\Resources\Dashboard\Category\CategoryListResource;
use App\Http\Resources\Dashboard\Category\CategoryShortListResource;

class CategoryListController extends CategoryController
{
    /** @var int $per_page */
    protected $per_page;

    /**
     * @param  CategoryListRequest  $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(CategoryListRequest $request)
    {
        $this->handleQueryParam($request);

        if ($this->per_page)
            return CategoryListResource::collection($this->service->getList($this->per_page))
                                       ->additional([
                                           'category_count' => $this->service->getCount()
                                       ]);

        return CategoryShortListResource::collection($this->service->getList());
    }

    /**
     * @param $request
     */
    protected function handleQueryParam($request)
    {
        $this->per_page = $request->get('per_page') ?? null;
    }
}
