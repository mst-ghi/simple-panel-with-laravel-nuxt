<?php

namespace App\Http\Resources\Dashboard\Auth;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserInfoResource
 *
 * @package App\Http\Resources\Dashboard\Auth
 *
 * @mixin User
 */
class UserInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'photo_url'   => $this->photo_url,
            'name'        => $this->name,
            'family'      => $this->family,
            'username'    => $this->username,
            'mobile'      => $this->mobile,
            'email'       => $this->email,
            'status'      => $this->status,
            'profile'     => $this->profile,
            'join_date'   => $this->j_created_at,
            'permissions' => $this->permissions
        ];
    }
}
