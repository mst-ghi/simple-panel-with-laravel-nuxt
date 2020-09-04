<?php

namespace App\Http\Resources\Dashboard\Address;

use App\Models\Address;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AddressShowResource
 *
 * @package App\Http\Resources\Dashboard\Address
 *
 * @mixin Address
 */
class AddressShowResource extends JsonResource
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
            'city_title'  => $this->city ? $this->city->name : '',
            'mobile'      => $this->mobile,
            'phone'       => $this->phone,
            'name'        => $this->name,
            'family'      => $this->family,
            'address'     => $this->address,
            'postal_code' => $this->postal_code,
            'latitude'    => $this->latitude,
            'longitude'   => $this->longitude,
            'default'     => $this->default,
        ];
    }
}
