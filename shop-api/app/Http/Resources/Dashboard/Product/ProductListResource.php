<?php

namespace App\Http\Resources\Dashboard\Product;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProductListResource
 *
 * @package App\Http\Resources\Dashboard\Product
 *
 * @mixin Product
 */
class ProductListResource extends JsonResource
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
            'id'          => $this->id,
            'photo_url'   => $this->photo_url,
            'brand_title' => $this->brand->title,
            'title_fa'    => $this->title_fa,
            'title_en'    => $this->title_en,
            'slug'        => $this->slug,
            'price'       => $this->price,
            'price_old'   => $this->price_old,
            'short_desc'  => $this->short_desc,
            'status'      => $this->status,
        ];
    }
}
