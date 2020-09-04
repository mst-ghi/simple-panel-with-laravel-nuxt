<?php

namespace App\Repositories;

use App\Models\AttributeItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AttributeItemRepository extends AttributeItem
{
    protected $table = 'attribute_items';

    /**
     * @param $per_page
     *
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    public function getList($per_page)
    {
        if ($per_page)
            return self::Active()->paginate($per_page);

        return self::Active()->get();
    }

    /**
     * @param $id
     *
     * @return AttributeItemRepository
     */
    public function findOne($id)
    {
        return self::with(['attribute'])->find($id);
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
