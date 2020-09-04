<?php

namespace App\Repositories;

use App\Models\Province;
use Illuminate\Support\Facades\Cache;

class ProvinceRepository extends Province
{
    protected $table = 'provinces';

    /**
     * @return int
     */
    public function getCount()
    {
        return Cache::remember('getCountProvince', $minute = '30', function ()
        {
            return self::count();
        });
    }

    /**
     * @param $per_page
     *
     * @return ProvinceRepository[]
     */
    public function getAll($per_page = null)
    {
        if ($per_page) return self::paginate($per_page);

        return Cache::remember("getAllProvince", $minute = '30', function () use ($per_page)
        {
            return self::all();
        });

    }

    /**
     * @param  array  $data
     *
     * @return ProvinceRepository
     */
    public function createNew(array $data)
    {
        return self::create($data);
    }
}
