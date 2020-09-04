<?php

namespace App\Http\Resources\Dashboard\Location\City;

use App\Models\City;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CityShortListResource
 *
 * @package App\Http\Resources\Dashboard\Location\City
 *
 * @mixin City
 */
class CityShortListResource extends JsonResource
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
