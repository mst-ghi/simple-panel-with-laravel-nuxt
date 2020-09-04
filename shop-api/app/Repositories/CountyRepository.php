<?php

namespace App\Repositories;

use App\Models\County;
use Illuminate\Support\Facades\Cache;

class CountyRepository extends County
{
    protected $table = 'counties';

    /**
     * @return int
     */
    public function getCount()
    {
        return Cache::remember('getCountCounty', $minute = '60', function ()
        {
            return self::count();
        });
    }

    /**
     * @param        $per_page
     *
     * @param  null  $province_id
     *
     * @return CountyRepository[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll($per_page = null, $province_id = null)
    {
        if ($per_page) return self::with(['province'])->paginate($per_page);

        elseif ($province_id) return self::where('province_id', $province_id)->get();

        return self::all();
    }

        /**
     * @param  array  $data
     *
     * @return CountyRepository
     */
    public function createNew(array $data)
    {
        return self::create($data);
    }
}
