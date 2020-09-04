<?php

namespace App\Http\Controllers\Dashboard\Banner;

use App\Http\Requests\Dashboard\Banner\BannerDestroyRequest;
use App\Models\Banner;

class BannerDestroyController extends BannerController
{
    /**
     * @param  BannerDestroyRequest  $request
     * @param  Banner                $banner
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function __invoke(BannerDestroyRequest $request, Banner $banner)
    {
        $this->service->setBanner($banner)->destroy();

        return $this->success(trans('messages.banner.api_update'));
    }
}
