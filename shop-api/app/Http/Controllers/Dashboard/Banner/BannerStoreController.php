<?php

namespace App\Http\Controllers\Dashboard\Banner;

use App\Http\Requests\Dashboard\Banner\BannerStoreRequest;
use App\Http\Resources\Dashboard\Banner\BannerShowResource;

class BannerStoreController extends BannerController
{
    /**
     * @param  BannerStoreRequest  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(BannerStoreRequest $request)
    {
        $data = $request->only([
            'brand_id',
            'category_id',
            'type',
            'size',
            'text',
            'close_able',
            'status',
        ]);

        $this->service
            ->setExpiresType($request->expires_type)
            ->setExpiresValue($request->expires_value)
            ->storeNew($data, $request->photo);

        return $this->success(
            trans('messages.banner.api_create'),
            new BannerShowResource($this->service->getBanner())
        );
    }
}
