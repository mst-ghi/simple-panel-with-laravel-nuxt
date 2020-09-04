<?php

namespace App\Http\Resources\Dashboard\Location\City;

use App\Models\City;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CityShowResource
 *
 * @package App\Http\Resources\Dashboard\Location\City
 *
 * @mixin City
 */
class CityShowResource extends JsonResource
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
            'id'            => $this->id,
            'province_id'   => $this->province_id,
            'province_name' => $this->province ? $this->province->name : null,
            'county_id'     => $this->county_id,
            'county_name'   => $this->county ? $this->county->name : null,
            'name'          => $this->name,
            'en_name'       => $this->en_name,
            'latitude'      => $this->latitude,
            'longitude'     => $this->longitude,
            'approved'      => $this->approved
        ];
    }
}
