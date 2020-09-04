<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends Product
{
    protected $table = 'products';

    /**
     * @param $filter
     * @param $per_page
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredList($filter, $per_page)
    {
        return self::Filter($filter)->orderBy('id', 'desc')->paginate($per_page);
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return self::count();
    }

    /**
     * @param  array  $data
     *
     * @return Product
     */
    public function createNew(array $data)
    {
        return self::create($data);
    }
}
