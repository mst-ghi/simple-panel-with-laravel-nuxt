<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryRepository extends Category
{
    protected $table = 'categories';

    /**
     * @return int
     */
    public function getCount()
    {
        return Cache::remember('getCountCategory', $minute = '30', function ()
        {
            return self::count();
        });
    }

    /**
     * @param $per_page
     *
     * @return CategoryRepository[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList($per_page)
    {

//        return Cache::remember('getListCategory', $minute = '30', function () use ($per_page)
//        {
        if ($per_page) {
            return self::with(['parent'])->paginate($per_page);
        }
        return self::all();
//        });

    }

    /**
     * @param  array  $data
     *
     * @return CategoryRepository
     */
    public function createNew(array $data)
    {
        return self::create($data);
    }
}
