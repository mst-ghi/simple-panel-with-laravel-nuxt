<?php

namespace App\Models;

use App\Traits\HasStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductAttribute
 *
 * @package App\Models
 *
 * @property integer       $id
 * @property integer       $product_id
 * @property integer       $attribute_id
 * @property integer       $attribute_item_id
 * @property boolean       $status
 * @property Carbon        $created_at
 * @property Carbon        $updated_at
 *
 * @property Product       $product
 * @property Attribute     $attribute
 * @property AttributeItem $item
 */
class ProductAttribute extends Model
{
    use HasStatus;

    protected $table = 'product_attributes';

    protected $fillable = [
        'product_id',
        'attribute_id',
        'attribute_item_id',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function item()
    {
        return $this->belongsTo(AttributeItem::class);
    }
}
