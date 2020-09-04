<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasStatus
 *
 * @package App\Traits
 *
 * @property boolean $status
 *
 * @method static Builder Active()
 * @method static Builder InActive()
 */
trait HasStatus
{
    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->where($this->table . '.status', true);
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeInActive(Builder $query)
    {
        return $query->where($this->table . '.status', false);
    }

}
