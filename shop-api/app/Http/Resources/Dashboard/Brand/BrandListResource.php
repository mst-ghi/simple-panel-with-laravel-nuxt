<?php

namespace App\Http\Resources\Dashboard\Brand;

use App\Models\Brand;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BrandListResource
 *
 * @package App\Http\Resources\Dashboard\Brand
 *
 * @mixin Brand
 */
class BrandListResource extends JsonResource
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
            'id'        => $this->id,
            'photo_url' => $this->photo_url,
            'slug'      => $this->slug,
            'title'     => $this->title,
            'status'    => $this->status,
        ];
    }
}
