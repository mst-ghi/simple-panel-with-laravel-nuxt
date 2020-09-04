<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class County
 *
 * @package App\Models
 *
 * @property integer  $id
 * @property integer  $province_id
 * @property string   $name
 * @property string   $en_name
 * @property double   $latitude
 * @property double   $longitude
 * @property boolean  $approved
 * @property Carbon   $created_at
 * @property Carbon   $updated_at
 *
 * @property Province $province
 * @property City[]   $cities
 */
class County extends Model
{
    use SoftDeletes;

    protected $table = 'counties';

    protected $fillable = [
        'province_id',
        'name',
        'en_name',
        'latitude',
        'longitude',
        'approved'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'county_id');
    }

}
