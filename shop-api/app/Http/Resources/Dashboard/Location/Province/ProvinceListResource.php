<?php

namespace App\Http\Resources\Dashboard\Location\Province;

use App\Models\Province;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProvinceListResource
 *
 * @package App\Http\Resources\Dashboard\Location\Province
 *
 * @mixin Province
 */
class ProvinceListResource extends JsonResource
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
            'name'      => $this->name,
            'en_name'   => $this->en_name,
            'area_code' => $this->area_code,
            'latitude'  => $this->latitude,
            'longitude' => $this->longitude,
            'approved'  => $this->approved
        ];
    }
}
