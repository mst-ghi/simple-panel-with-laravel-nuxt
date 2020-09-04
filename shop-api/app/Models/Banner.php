<?php

namespace App\Models;

use App\Traits\HasPhoto;
use App\Traits\HasStatus;
use App\Traits\JCreatedAt;
use App\Traits\JExpiredAt;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Banner
 *
 * @package App\Models
 *
 * @property integer  $id
 * @property integer  $photo_id
 * @property integer  $brand_id
 * @property integer  $category_id
 * @property string   $brand_title
 * @property string   $category_title
 * @property string   $type
 * @property string   $size
 * @property string   $text
 * @property boolean  $close_able
 * @property boolean  $status
 * @property Carbon   $expires_at
 * @property Carbon   $created_at
 * @property Carbon   $updated_at
 * @property Carbon   $deleted_at
 *
 * @property Brand    $brand
 * @property Category $category
 *
 * @method static Builder NotExpires()
 * @method static Builder CloseAble()
 * @method static Builder UnCloseAble()
 */
class Banner extends Model
{
    use SoftDeletes, HasPhoto, HasStatus, JExpiredAt, JCreatedAt;

    const TYPE_BRAND    = 'brand';
    const TYPE_CATEGORY = 'category';
    const TYPE_LIST     = [
        self::TYPE_BRAND,
        self::TYPE_CATEGORY
    ];

    const SIZE_SMALL  = 'small';
    const SIZE_MEDIUM = 'medium';
    const SIZE_LARGE  = 'large';
    const SIZE_LIST   = [
        self::SIZE_SMALL,
        self::SIZE_MEDIUM,
        self::SIZE_LARGE,
    ];

    const EXPIRES_DAY = 'day';
    const EXPIRES_HOURS = 'hours';
    const EXPIRES_LIST = [
        self::EXPIRES_DAY,
        self::EXPIRES_HOURS,
    ];

    protected $table = 'banners';

    protected $fillable = [
        'photo_id',
        'brand_id',
        'category_id',
        'type',
        'size',
        'text',
        'close_able',
        'status',
        'expires_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'expires_at'
    ];

    public function getBrandTitleAttribute()
    {
        return $this->brand ? $this->brand->title : '';
    }

    public function getCategoryTitleAttribute()
    {
        return $this->category ? $this->category->title : '';
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeNotExpires(Builder $query)
    {
        return $query->where($this->table . '.expires_at', '>=', Carbon::now());
    }

    public function scopeCloseAble(Builder $query)
    {
        return $query->where($this->table . '.close_able', true);
    }

    public function scopeUnCloseAble(Builder $query)
    {
        return $query->where($this->table . '.close_able', false);
    }
}
