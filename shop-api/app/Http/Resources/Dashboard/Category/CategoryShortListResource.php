<?php

namespace App\Http\Resources\Dashboard\Category;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CategoryShortListResource
 *
 * @package App\Http\Resources\Dashboard\Category
 *
 * @mixin Category
 */
class CategoryShortListResource extends JsonResource
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
