<?php

namespace App\Http\Resources\Dashboard\Location\County;

use App\Models\County;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CountyShowResource
 *
 * @package App\Http\Resources\Dashboard\Location\County
 *
 * @mixin County
 */
class CountyShowResource extends JsonResource
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
            'province_name' => $this->province ? $this->province->name : '',
            'name'          => $this->name,
            'en_name'       => $this->en_name,
            'latitude'      => $this->latitude,
            'longitude'     => $this->longitude,
            'approved'      => $this->approved
        ];
    }
}
