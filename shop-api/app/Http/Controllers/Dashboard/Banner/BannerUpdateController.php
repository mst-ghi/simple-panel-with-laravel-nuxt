<?php

namespace App\Http\Controllers\Dashboard\Banner;

use App\Http\Requests\Dashboard\Banner\BannerUpdateRequest;
use App\Models\Banner;

class BannerUpdateController extends BannerController
{
    /**
     * @param  BannerUpdateRequest  $request
     * @param  Banner               $banner
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function __invoke(BannerUpdateRequest $request, Banner $banner)
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
            ->update($data, $request->photo);

        return $this->success(trans('messages.banner.api_update'));
    }
}
