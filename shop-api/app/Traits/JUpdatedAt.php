<?php

namespace App\Traits;

use Hekmatinasser\Verta\Verta;

/**
 * Trait JUpdatedAt
 *
 * @package App\Traits
 *
 * @property Verta $j_updated_at
 */
trait JUpdatedAt
{
    public function getJUpdatedAtAttribute()
    {
        return Verta::instance($this->updated_at)->format('H:i  Y/n/d');
    }

}
