<?php

namespace App\Http\Resources\Dashboard\User;

use App\Http\Resources\Dashboard\Role\RoleShowResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserInfoResource
 *
 * @package App\Http\Resources\Dashboard\User
 *
 * @mixin User
 */
class UserInfoResource extends JsonResource
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
            'photo_url' => $this->photo_url,
            'name'      => $this->name,
            'family'    => $this->family,
            'username'  => $this->username,
            'mobile'    => $this->mobile,
            'email'     => $this->email,
            'status'    => $this->status,
            'role'      => new RoleShowResource($this->roles[0])
        ];
    }
}
