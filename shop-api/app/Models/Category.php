<?php

namespace App\Models;

use App\Traits\HasStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 *
 * @package App\Models
 *
 * @property integer          $id
 * @property integer          $parent_id
 * @property string           $slug
 * @property string           $title
 * @property integer          $depth
 * @property string           $path
 * @property boolean          $status
 * @property Carbon           $deleted_at
 * @property Carbon           $created_at
 * @property Carbon           $updated_at
 *
 * @property Category[]       $categories
 * @property Category         $parent
 * @property Product[]        $products
 * @property AttributeGroup[] $attributeGroups
 * @property Banner[]         $banners
 */
class Category extends Model
{
    use SoftDeletes, HasStatus;

    protected $table = 'categories';

    protected $fillable = [
        'parent_id',
        'slug',
        'title',
        'depth',
        'path',
        'status',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    // Relations

    public function categories()
    {
        return $this->hasMany(
            Category::class,
            'parent_id'
        );
    }

    public function parent()
    {
        return $this->belongsTo(
            Category::class,
            'parent_id',
            'id'
        );
    }

    public function products()
    {
        return $this->belongsToMany(
            Category::class,
            'category_product',
            'category_id',
            'product_id'
        );
    }

    public function attributeGroups()
    {
        return $this->hasMany(
            AttributeGroup::class,
            'category_id'
        );
    }

    public function banners()
    {
        return $this->hasMany(
            Banner::class,
            'category_id'
        );
    }


    // methods

    public function parentDepth($id = null)
    {
        if ($id)
            return self::where('id', $id)->first()->depth + 1;
        return 0;
    }

    public function parentPath($id = null)
    {
        if ($id) {
            $ctg = self::where('id', $id)->first();
            return $ctg->path . (count(explode('-', $ctg->path)) - 1) . '-';
        }
        return '0-';
    }
}
