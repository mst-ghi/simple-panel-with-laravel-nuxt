<?php

namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Support\Facades\Cache;

class BrandRepository extends Brand
{
    protected $table = 'brands';

    /**
     * @return BrandRepository[]
     */
    public function getList()
    {
//        return Cache::remember('getBrandList', $minute = '60', function (){
            return self::all();
//        });
    }

    /**
     * @return int
     */
    public function getCount()
    {
//        return Cache::remember('getBrandCount', $minute = '60', function (){
            return self::count();
//        });
    }

    /**
     * @param  array  $data
     *
     * @return BrandRepository
     */
    public function createNew(array $data)
    {
        return self::create($data);
    }
}
