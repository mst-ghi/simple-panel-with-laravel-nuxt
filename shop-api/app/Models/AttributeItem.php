<?php

namespace App\Models;

use App\Traits\HasStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AttributeItem
 *
 * @package App\Models
 *
 * @property integer            $id
 * @property integer            $attribute_id
 * @property string             $title
 * @property boolean            $status
 * @property Carbon             $created_at
 * @property Carbon             $updated_at
 *
 * @property Attribute          $attribute
 * @property ProductAttribute[] $productItems
 */
class AttributeItem extends Model
{
    use HasStatus;

    protected $table = 'attribute_items';

    protected $fillable = [
        'attribute_id',
        'title',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function productItems()
    {
        return $this->hasMany(ProductAttribute::class, 'attribute_item_id');
    }
}
