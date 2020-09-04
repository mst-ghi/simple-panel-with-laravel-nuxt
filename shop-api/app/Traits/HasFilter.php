<?php

namespace App\Traits;

use App\Tools\Filter\Filter;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasFilter
 *
 * @package App\Traits
 *
 * @method static Builder Filter($filter)
 */
trait HasFilter
{
    /**
     * @return array
     */
    public function getRelationArray()
    {
        return $this->relations;
    }

    /**
     * @param        $query
     * @param Filter $filter
     *
     * @return Builder
     */
    public function scopeFilter($query, Filter $filter)
    {
        $filter->setRelations($this->relations);
        return $filter->apply($query);
    }
}
