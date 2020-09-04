<?php

namespace App\Http\Resources\Dashboard\Brand;

use App\Models\Brand;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BrandShortListResource
 *
 * @package App\Http\Resources\Dashboard\Brand
 *
 * @mixin Brand
 */
class BrandShortListResource extends JsonResource
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
