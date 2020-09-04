<?php

namespace App\Http\Resources\Dashboard\Permission;

use App\Models\Permission;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PermissionListResource
 *
 * @package App\Http\Resources\Dashboard\Permission
 *
 * @mixin Permission
 */
class PermissionListResource extends JsonResource
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
        ];
    }
}
