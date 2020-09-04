<?php

namespace App\Http\Resources\Dashboard\Role;

use App\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RoleListResource
 *
 * @package App\Http\Resources\Dashboard\Role
 *
 * @mixin Role
 */
class RoleListResource extends JsonResource
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
            'label'       => $this->label,
            'title'       => $this->title,
            'description' => $this->description,
        ];
    }
}
