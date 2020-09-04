<?php

namespace App\Http\Resources\Dashboard\Category;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CategoryListResource
 *
 * @package App\Http\Resources\Dashboard\Category
 *
 * @mixin Category
 */
class CategoryListResource extends JsonResource
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
            'id'          => $this->id,
            'parent_id'   => $this->parent_id,
            'parent_name' => $this->parent_id ? $this->parent->title : 'بدون پرنت',
            'slug'        => $this->slug,
            'title'       => $this->title,
            'depth'       => $this->depth,
            'path'        => $this->path,
            'status'      => $this->status,
        ];
    }
}
