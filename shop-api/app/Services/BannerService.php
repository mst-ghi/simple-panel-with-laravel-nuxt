<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\Photo;
use App\Repositories\BannerRepository;
use App\Repositories\PhotoRepository;
use Carbon\Carbon;

class BannerService
{
    /**
     * @var BannerRepository $repository
     */
    protected $repository;

    /**
     * @var PhotoRepository $photoRepository
     */
    protected $photoRepository;

    /** @var Banner $banner */
    protected $banner;

    /** @var Photo $photo */
    protected $photo;

    /** @var string $expires_type */
    protected $expires_type;

    /** @var int $expires_value */
    protected $expires_value;

    /**
     * BannerService constructor.
     *
     * @param  BannerRepository  $repository
     * @param  PhotoRepository   $photoRepository
     */
    public function __construct(BannerRepository $repository, PhotoRepository $photoRepository)
    {
        $this->repository      = $repository;
        $this->photoRepository = $photoRepository;
    }

    /**
     * @param  int|null  $per_page
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList(int $per_page = null)
    {
        return $this->repository->getList($per_page ?? config('paginate.banners'));
    }

    /**
     * @param  array  $data
     * @param         $photo
     */
    public function storeNew(array $data, $photo)
    {
        $this->createPhoto($photo);

        $data = array_merge($data, [
            'photo_id'   => $this->photo->id,
            'expires_at' => $this->getExpires()
        ]);

        $this->banner = $this->repository->storeNew($data);
    }

    /**
     * @param  array  $data
     * @param  null   $photo
     *
     * @throws \Exception
     */
    public function update(array $data, $photo = null)
    {
        $old_photo = null;

        if ($photo) {
            $old_photo = $this->banner->photo;

            $this->createPhoto($photo);

            $data = array_merge($data, ['photo_id' => $this->photo->id]);
        }

        if ($this->expires_value)
            $data = array_merge($data, ['expires_at' => $this->getExpires()]);


        $this->banner->update($data);

        if ($old_photo) $this->photoRepository->destroyPhoto($old_photo);
    }

    /**
     * @param $photo
     */
    public function createPhoto($photo)
    {
        $data = [
            'thumbnail' => photoUploader($photo, Photo::TYPE_THUMBNAILS, mt_rand(10, 99)),
            'path'      => photoUploader($photo, Photo::TYPE_BANNERS, mt_rand(10, 99)),
            'ext'       => $photo->getClientOriginalExtension(),
        ];

        $this->photo = $this->photoRepository->createNew($data);
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function destroy()
    {
        return $this->banner->delete();
    }

    /**
     * @return Carbon
     */
    public function getExpires()
    {
        return $this->expires_type == Banner::EXPIRES_DAY ?
            Carbon::now()->addDays($this->expires_value) :
            Carbon::now()->addHours($this->expires_value);
    }

    /**
     * @return array
     */
    public function getCount()
    {
        return [
            'banner_count' => $this->repository->getCount()
        ];
    }

    /**
     * @return Banner
     */
    public function getBanner(): Banner
    {
        return $this->banner;
    }

    /**
     * @param  Banner  $banner
     *
     * @return BannerService
     */
    public function setBanner(Banner $banner): BannerService
    {
        $this->banner = $banner;
        return $this;
    }

    /**
     * @return Photo
     */
    public function getPhoto(): Photo
    {
        return $this->photo;
    }

    /**
     * @param  Photo  $photo
     *
     * @return BannerService
     */
    public function setPhoto(Photo $photo): BannerService
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpiresType(): string
    {
        return $this->expires_type;
    }

    /**
     * @param  string  $expires_type
     *
     * @return BannerService
     */
    public function setExpiresType(string $expires_type): BannerService
    {
        $this->expires_type = $expires_type;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpiresValue(): int
    {
        return $this->expires_value;
    }

    /**
     * @param  int  $expires_value
     *
     * @return BannerService
     */
    public function setExpiresValue(int $expires_value): BannerService
    {
        $this->expires_value = $expires_value;
        return $this;
    }
}
