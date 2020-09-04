<?php

namespace App\Traits;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;

/**
 * Trait JCreatedAt
 *
 * @package App\Traits
 *
 * @property Verta $j_created_at
 */
trait JCreatedAt
{
    public function getJCreatedAtAttribute()
    {
        return Verta::instance($this->created_at)->format('H:i  Y/n/d');
    }

	public function formatDifference(Carbon $carbon)
	{
		return verta($carbon)->formatDifference(verta());
    }

	public function formatWord(Carbon $carbon)
	{
		$v = verta($carbon);
		$date = $v->format('%d %B %Y');
		return $v->formatWord('l') . ' ' . $date;
    }

}
