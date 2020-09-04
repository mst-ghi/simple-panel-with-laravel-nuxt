<?php

namespace App\Repositories;

use App\Models\City;
use Illuminate\Support\Facades\Cache;

class CityRepository extends City
{
    protected $table = 'cities';

    /**
     * @return int
     */
    public function getCount()
    {
        return Cache::remember('getCountCity', $minute = '30', function ()
        {
            return self::count();
        });
    }

    /**
     * @param $per_page
     *
     * @return CityRepository[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll($per_page)
    {
        return self::with(['province', 'county'])->paginate($per_page);
    }

    /**
     * @param $county_id
     *
     * @return CityRepository[]
     */
    public function getShortList($county_id)
    {
        return self::where('county_id', $county_id)->get();
    }

    /**
     * @param  array  $data
     *
     * @return CityRepository
     */
    public function createNew(array $data)
    {
        return self::create($data);
    }
}
