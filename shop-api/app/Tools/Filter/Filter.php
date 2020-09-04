<?php

namespace App\Tools\Filter;

class Filter extends AbstractFilter
{

    /**
     * eager loading the relations
     *
     * @param null $relations
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function with($relations = null)
    {
        $relations = explode(',', array_unwrap($relations));

        return $this->builder->with(array_intersect($relations, $this->relations));
    }
}
