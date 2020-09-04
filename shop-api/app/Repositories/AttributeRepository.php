<?php

namespace App\Repositories;

use App\Models\Attribute;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AttributeRepository extends Attribute
{
    protected $table = 'attributes';

    /**
     * @param $per_page
     *
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    public function getList($per_page)
    {
        if ($per_page) return self::with(['group'])->Active()->paginate($per_page);

        return self::Active()->get();
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return self::Active()->count();
    }

    /**
     * @param array $data
     *
     * @return AttributeRepository
     */
    public function createNew(array $data)
    {
        return self::create($data);
    }
}
