<?php

namespace App\Http\Resources\Dashboard\Attribute\Group;

use App\Models\AttributeGroup;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AttributeGroupListResource
 *
 * @package App\Http\Resources\Dashboard\Attribute\Group
 *
 * @mixin AttributeGroup
 */
class AttributeGroupListResource extends JsonResource
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
            'id'             => $this->id,
            'category_id'    => $this->category_id,
            'category_title' => $this->category_id ? $this->category->title : 'بدون دسته بندی',
            'title'          => $this->title,
            'status'         => $this->status,
        ];
    }
}
