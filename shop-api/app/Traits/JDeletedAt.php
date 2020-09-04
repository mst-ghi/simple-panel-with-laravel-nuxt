<?php

namespace App\Traits;

use Hekmatinasser\Verta\Verta;

/**
 * Trait JDeletedAt
 *
 * @package App\Traits
 *
 * @property Verta $j_deleted_at
 */
trait JDeletedAt
{
    public function getJDeletedAtAttribute()
    {
        return Verta::instance($this->deleted_at)->format('H:i  Y/n/d');
    }

}
