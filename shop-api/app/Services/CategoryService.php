<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService
{
    /** @var CategoryRepository $repository */
    protected $repository;

    /** @var Category $category */
    protected $category;

    /**
     * CategoryService constructor.
     *
     * @param  CategoryRepository  $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  null  $per_page
     *
     * @return CategoryRepository[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList($per_page = null)
    {
        return $this->repository->getList($per_page);
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->repository->getCount();
    }

    /**
     * @param  array  $data
     *
     * @return CategoryRepository
     */
    public function create(array $data)
    {
        $data = array_merge($data, [
            'depth' => $this->repository->parentDepth($data['parent_id'] ?? null),
            'path'  => $this->repository->parentPath($data['parent_id'] ?? null)
        ]);
        return $this->repository->createNew($data);
    }

    /**
     * @param  array  $data
     */
    public function update(array $data)
    {
        $data = array_merge($data, [
            'depth' => $this->repository->parentDepth($data['parent_id'] ?? null),
            'path'  => $this->repository->parentPath($data['parent_id'] ?? null)
        ]);
        $this->category->update($data);
    }

    /**
     * @throws \Exception
     */
    public function destroy()
    {
        $this->category->delete();
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param  Category  $category
     *
     * @return CategoryService
     */
    public function setCategory(Category $category): CategoryService
    {
        $this->category = $category;
        return $this;
    }


}
