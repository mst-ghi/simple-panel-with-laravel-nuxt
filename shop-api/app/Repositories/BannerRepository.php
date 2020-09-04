<?php

namespace App\Repositories;

use App\Models\Banner;

class BannerRepository extends Banner
{
    protected $table = 'banners';

    /**
     * @param $per_page
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList($per_page)
    {
        return self::with(['brand', 'category'])->paginate($per_page);
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
     * @return BrandRepository
     */
    public function storeNew(array $data)
    {
        return self::create($data);
    }
}
