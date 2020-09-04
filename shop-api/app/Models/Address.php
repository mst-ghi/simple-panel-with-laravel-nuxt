<?php

namespace App\Models;

use App\Traits\JCreatedAt;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Address
 *
 * @package App\Models
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $city_id
 * @property integer $county_id
 * @property integer $province_id
 * @property string  $mobile
 * @property string  $phone
 * @property string  $full_name
 * @property string  $city_name
 * @property string  $county_name
 * @property string  $province_name
 * @property string  $name
 * @property string  $family
 * @property string  $address
 * @property string  $postal_code
 * @property double  $latitude
 * @property double  $longitude
 * @property boolean $default
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Carbon  $deleted_at
 *
 * @property User    $user
 * @property City    $city
 *
 * @method static Builder IsDefault()
 * @method static Builder IsNotDefault()
 */
class Address extends Model
{
    use SoftDeletes, JCreatedAt;

    protected $table = 'addresses';

    protected $fillable = [
        'user_id',
        'city_id',
        'mobile',
        'phone',
        'name',
        'family',
        'address',
        'postal_code',
        'latitude',
        'longitude',
        'default',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->family;
    }

    public function getCityNameAttribute()
    {
        return $this->city ? $this->city->name : '';
    }

    public function getCountyNameAttribute()
    {
        return $this->city && $this->city->county ? $this->city->county->name : '';
    }

    public function getProvinceNameAttribute()
    {
        return $this->city && $this->city->province ? $this->city->province->name : '';
    }

    public function getCountyIdAttribute()
    {
        return $this->city && $this->city->county ? $this->city->county_id : '';
    }

    public function getProvinceIdAttribute()
    {
        return $this->city && $this->city->province ? $this->city->province_id : '';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function scopeIsDefault(Builder $query)
    {
        return $query->where($this->table . '.default', true);
    }

    public function scopeIsNotDefault(Builder $query)
    {
        return $query->where($this->table . '.default', false);
    }
}
