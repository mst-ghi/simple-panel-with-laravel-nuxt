<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class City
 *
 * @package App\Models
 *
 * @property integer   $id
 * @property integer   $province_id
 * @property integer   $county_id
 * @property string    $name
 * @property string    $en_name
 * @property double    $latitude
 * @property double    $longitude
 * @property boolean   $approved
 * @property Carbon    $created_at
 * @property Carbon    $updated_at
 *
 * @property Province  $province
 * @property County    $county
 * @property Address[] $addresses
 */
class City extends Model
{
    use SoftDeletes;

    protected $table = 'cities';

    protected $fillable = [
        'province_id',
        'county_id',
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

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'city_id');
    }
}
