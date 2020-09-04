<?php

namespace App\Repositories;

use App\Models\AttributeGroup;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AttributeGroupRepository extends AttributeGroup
{
    protected $table = 'attribute_groups';

    /**
     * @param $per_page
     *
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    public function getList($per_page)
    {
        if ($per_page) return self::with(['category'])->Active()->paginate($per_page);

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
     * @return AttributeGroupRepository
     */
    public function createNew(array $data)
    {
        return self::create($data);
    }
}
