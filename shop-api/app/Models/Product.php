<?php

namespace App\Models;

use App\Traits\HasFilter;
use App\Traits\HasPhoto;
use App\Traits\HasStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 *
 * @package App\Models
 *
 * @property integer            $id
 * @property integer            $brand_id
 * @property string             $title_fa
 * @property string             $title_en
 * @property string             $slug
 * @property double             $price
 * @property double             $price_old
 * @property string             $short_desc
 * @property string             $long_desc
 * @property boolean            $status
 * @property Carbon             $deleted_at
 * @property Carbon             $created_at
 * @property Carbon             $updated_at
 *
 * @property Brand              $brand
 * @property Category[]         $categories
 * @property ProductAttribute[] $productItems
 */
class Product extends Model
{
    use SoftDeletes, HasPhoto, HasFilter, HasStatus;

    protected $table = 'products';

    protected $fillable = [
        'photo_id',
        'brand_id',
        'title_fa',
        'title_en',
        'slug',
        'price',
        'price_old',
        'short_desc',
        'long_desc',
        'status',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'category_product',
            'product_id',
            'category_id'
        );
    }

    public function productItems()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }
}
