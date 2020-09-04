<?php

namespace App\Models;

use App\Traits\HasPhoto;
use App\Traits\HasStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Brand
 *
 * @package App\Models
 *
 * @property integer   $id
 * @property integer   $photo_id
 * @property string    $slug
 * @property string    $title
 * @property boolean   $status
 * @property Carbon    $deleted_at
 * @property Carbon    $created_at
 * @property Carbon    $updated_at
 *
 * @property Product[] $products
 * @property Banner[]  $banners
 */
class Brand extends Model
{
    use SoftDeletes, HasPhoto, HasStatus;

    protected $defaultNoPhoto     = '/img/no-image.jpg';
    protected $defaultNoThumbnail = '/img/no-image.jpg';

    protected $table = 'brands';

    protected $fillable = [
        'photo_id',
        'slug',
        'title',
        'status',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

    public function banners()
    {
        return $this->hasMany(Banner::class, 'brand_id');
    }

}
