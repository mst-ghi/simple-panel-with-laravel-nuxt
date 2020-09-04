<?php

namespace App\Http\Resources\Dashboard\Banner;

use App\Models\Banner;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BannerListResource
 *
 * @package App\Http\Resources\Dashboard\Banner
 *
 * @mixin Banner
 */
class BannerListResource extends JsonResource
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
            'id'             => $this->id,
            'photo_url'      => $this->photo_url,
            'brand_id'       => $this->brand_id,
            'category_id'    => $this->category_id,
            'brand_title'    => $this->brand_title,
            'category_title' => $this->category_title,
            'type'           => $this->type,
            'size'           => $this->size,
            'text'           => $this->text,
            'close_able'     => $this->close_able,
            'status'         => $this->status,
            'expires_at'     => $this->j_expired_at
        ];
    }
}
