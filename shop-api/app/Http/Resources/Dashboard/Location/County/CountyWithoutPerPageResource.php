<?php

namespace App\Http\Resources\Dashboard\Location\County;

use App\Models\County;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CountyWithoutPerPageResource
 *
 * @package App\Http\Resources\Dashboard\Location\County
 *
 * @mixin County
 */
class CountyWithoutPerPageResource extends JsonResource
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
