<?php

namespace App\Models;

use App\Traits\HasFilter;
use App\Traits\HasStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AttributeGroup
 *
 * @package App\Models
 *
 * @property integer     $id
 * @property integer     $category_id
 * @property string      $title
 * @property boolean     $status
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 *
 * @property Category    $category
 * @property Attribute[] $attributes
 */
class AttributeGroup extends Model
{
    use SoftDeletes, HasStatus, HasFilter;

    protected $table = 'attribute_groups';

    protected $fillable = [
        'category_id',
        'title',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'attribute_group_id');
    }
}
