<?php

namespace App\Http\Resources\Dashboard\Address;

use App\Models\Address;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AddressListResource
 *
 * @package App\Http\Resources\Dashboard\Address
 *
 * @mixin Address
 */
class AddressListResource extends JsonResource
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
            'city_id'       => $this->city_id,
            'city_name'     => $this->city_name,
            'county_name'   => $this->county_name,
            'county_id'     => $this->county_id,
            'province_name' => $this->province_name,
            'province_id'   => $this->province_id,
            'mobile'        => $this->mobile,
            'phone'         => $this->phone,
            'name'          => $this->name,
            'family'        => $this->family,
            'address'       => $this->address,
            'postal_code'   => $this->postal_code,
            'latitude'      => $this->latitude,
            'longitude'     => $this->longitude,
            'default'       => $this->default,
        ];
    }
}
