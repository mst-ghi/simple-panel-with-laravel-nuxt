<?php

namespace App\Http\Resources\Dashboard\Attribute\Attribute;

use App\Models\Attribute;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AttributeShortListResource
 *
 * @package App\Http\Resources\Dashboard\Attribute\Attribute
 *
 * @mixin Attribute
 */
class AttributeShortListResource extends JsonResource
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
