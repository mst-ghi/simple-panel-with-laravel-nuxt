<?php

namespace App\Models;

use App\Traits\HasStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Attribute
 *
 * @package App\Models
 *
 * @property integer            $id
 * @property integer            $attribute_group_id
 * @property string             $type
 * @property string             $title
 * @property string             $slug
 * @property boolean            $status
 * @property Carbon             $created_at
 * @property Carbon             $updated_at
 *
 * @property AttributeGroup     $group
 * @property AttributeItem[]    $items
 * @property ProductAttribute[] $productItems
 */
class Attribute extends Model
{
    use HasStatus;

    const TYPE_TEXT       = 'text';
    const TYPE_CHECK_BAX  = 'check_box';
    const TYPE_SELECT_BAX = 'select_box';

    const TYPE_LIST = [
        self::TYPE_TEXT,
        self::TYPE_CHECK_BAX,
        self::TYPE_SELECT_BAX,
    ];

    protected $table = 'attributes';

    protected $fillable = [
        'attribute_group_id',
        'type',
        'title',
        'slug',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function group()
    {
        return $this->belongsTo(AttributeGroup::class);
    }

    public function items()
    {
        return $this->hasMany(AttributeItem::class, 'attribute_id');
    }

    public function productItems()
    {
        return $this->hasMany(ProductAttribute::class, 'attribute_id');
    }
}
