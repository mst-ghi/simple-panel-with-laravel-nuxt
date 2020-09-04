<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Province
 *
 * @package App\Models
 *
 * @property integer  $id
 * @property string   $name
 * @property string   $en_name
 * @property int      $area_code
 * @property double   $latitude
 * @property double   $longitude
 * @property boolean  $approved
 * @property Carbon   $created_at
 * @property Carbon   $updated_at
 *
 * @property County[] $counties
 * @property City[]   $cities
 */
class Province extends Model
{
    use SoftDeletes;

    protected $table = 'provinces';

    protected $fillable = [
        'name',
        'en_name',
        'area_code',
        'latitude',
        'longitude',
        'approved'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function counties()
    {
        return $this->hasMany(County::class, 'province_id');
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'province_id');
    }

}
