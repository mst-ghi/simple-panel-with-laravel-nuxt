<?php

namespace App\Services;


use App\Models\Brand;
use App\Models\Photo;
use App\Repositories\BrandRepository;
use App\Repositories\PhotoRepository;

class BrandService
{
    /** @var BrandRepository $repository */
    protected $repository;

    /** @var PhotoRepository $photoRepository */
    protected $photoRepository;

    /** @var Brand $brand */
    protected $brand;

    /** @var PhotoRepository $photo */
    protected $photo;

    /**
     * BrandService constructor.
     *
     * @param  BrandRepository  $repository
     * @param  PhotoRepository  $photoRepository
     */
    public function __construct(BrandRepository $repository, PhotoRepository $photoRepository)
    {
        $this->repository      = $repository;
        $this->photoRepository = $photoRepository;
    }

    /**
     * @return BrandRepository[]
     */
    public function getList()
    {
        return $this->repository->getList();
    }

    /**
     * @return int
     */
    public function getBrandsCount()
    {
        return $this->repository->getCount();
    }

    /**
     * @param  array  $data
     * @param  null   $photo
     *
     * @return BrandRepository
     */
    public function create(array $data, $photo = null)
    {
        if ($photo) $this->createPhoto($photo);

        if ($this->photo) $data = array_merge($data, [
            'photo_id' => $this->photo->id
        ]);

        return $this->repository->createNew($data);
    }

    /**
     * @param $photo
     */
    public function createPhoto($photo)
    {
        $data = [
            'thumbnail' => photoUploader($photo, Photo::TYPE_THUMBNAILS, mt_rand(10, 99)),
            'path'      => photoUploader($photo, Photo::TYPE_BRANDS, mt_rand(10, 99)),
            'ext'       => $photo->getClientOriginalExtension(),
        ];

        $this->photo = $this->photoRepository->createNew($data);
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
            $old_photo = $this->brand->photo;

            $this->createPhoto($photo);

            $data = array_merge($data, [
                'photo_id' => $this->photo->id
            ]);
        }

        $this->brand->update($data);

        if ($old_photo) $this->photoRepository->destroyPhoto($old_photo);
    }

    /**
     * @throws \Exception
     */
    public function destroy()
    {
        /** @var Photo $photo */
//        $photo = $this->brand->photo;

//        if ($photo) $this->photoRepository->destroyPhoto($photo);

        $this->brand->delete();
    }

    /**
     * @return Brand
     */
    public function getBrand(): Brand
    {
        return $this->brand;
    }

    /**
     * @param  Brand  $brand
     *
     * @return BrandService
     */
    public function setBrand(Brand $brand): BrandService
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return PhotoRepository
     */
    public function getPhoto(): PhotoRepository
    {
        return $this->photo;
    }

    /**
     * @param  PhotoRepository  $photo
     *
     * @return BrandService
     */
    public function setPhoto(PhotoRepository $photo): BrandService
    {
        $this->photo = $photo;
        return $this;
    }


}
