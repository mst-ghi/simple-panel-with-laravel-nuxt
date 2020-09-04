<?php

namespace App\Http\Resources\Dashboard\Attribute\Item;

use App\Models\AttributeItem;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AttributeItemShowResource
 *
 * @package App\Http\Resources\Dashboard\Attribute\Item
 *
 * @mixin AttributeItem
 */
class AttributeItemShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'attribute_id'    => $this->attribute_id,
            'attribute_title' => $this->attribute ? $this->attribute->title : 'بدون خصوصیت',
            'title'           => $this->title,
            'status'          => $this->status,
        ];
    }
}
