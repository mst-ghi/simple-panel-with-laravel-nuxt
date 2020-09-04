<?php

namespace App\Http\Resources\Dashboard\Location\Province;

use App\Models\Province;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProvinceWithoutPerPageResource
 *
 * @package App\Http\Resources\Dashboard\Location\Province
 *
 * @mixin Province
 */
class ProvinceWithoutPerPageResource extends JsonResource
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
            'text'  => $this->name,
        ];
    }
}
