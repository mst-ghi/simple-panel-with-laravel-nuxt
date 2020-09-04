<?php

namespace App\Http\Resources\Dashboard\Attribute\Item;

use App\Models\AttributeItem;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AttributeItemShortListResource
 *
 * @package App\Http\Resources\Dashboard\Attribute\Item
 *
 * @mixin AttributeItem
 */
class AttributeItemShortListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'value' => $this->id,
            'text'  => $this->title,
        ];
    }
}
