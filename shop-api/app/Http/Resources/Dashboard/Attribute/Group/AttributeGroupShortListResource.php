<?php

namespace App\Http\Resources\Dashboard\Attribute\Group;

use App\Models\AttributeGroup;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AttributeGroupShortListResource
 *
 * @package App\Http\Resources\Dashboard\Attribute\Group
 *
 * @mixin AttributeGroup
 */
class AttributeGroupShortListResource extends JsonResource
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
