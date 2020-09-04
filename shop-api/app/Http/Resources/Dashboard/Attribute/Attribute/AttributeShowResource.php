<?php

namespace App\Http\Resources\Dashboard\Attribute\Attribute;

use App\Models\Attribute;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AttributeShowResource
 *
 * @package App\Http\Resources\Dashboard\Attribute\Attribute
 *
 * @mixin Attribute
 */
class AttributeShowResource extends JsonResource
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
            'id'                    => $this->id,
            'attribute_group_id'    => $this->attribute_group_id,
            'attribute_group_title' => $this->group ? $this->group->title : 'بدون گروه',
            'type'                  => $this->type,
            'type_title'            => trans('messages.attribute.types.' . $this->type),
            'title'                 => $this->title,
            'slug'                  => $this->slug,
            'status'                => $this->status,
        ];
    }
}
