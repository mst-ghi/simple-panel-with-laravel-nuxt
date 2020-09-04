<?php

namespace App\Http\Resources\Dashboard\Product;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProductShowResource
 *
 * @package App\Http\Resources\Dashboard\Product
 *
 * @mixin Product
 */
class ProductShowResource extends JsonResource
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
            'id'           => $this->id,
            'brand_id'     => $this->brand_id,
            'photo_url'    => $this->photo_url,
            'brand_title'  => $this->brand->title,
            'title_fa'     => $this->title_fa,
            'title_en'     => $this->title_en,
            'slug'         => $this->slug,
            'price'        => $this->price,
            'price_old'    => $this->price_old,
            'short_desc'   => $this->short_desc,
            'long_desc'    => $this->long_desc,
            'status'       => $this->status,
            'category_ids' => $this->categories()->get()->pluck('id'),
            'item_ids'     => $this->productItems()->get()->pluck('attribute_item_id'),
        ];
    }
}
