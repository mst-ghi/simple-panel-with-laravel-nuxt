<?php

namespace App\Traits;

use Hekmatinasser\Verta\Verta;

/**
 * Trait JExpiredAt
 *
 * @package App\Traits
 *
 * @property Verta $j_expired_at
 */
trait JExpiredAt
{
    public function getJExpiredAtAttribute()
    {
        return Verta::instance($this->expired_at)->format('H:i  Y/n/d');
    }

}
