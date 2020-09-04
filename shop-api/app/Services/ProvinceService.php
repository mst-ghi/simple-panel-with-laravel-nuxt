<?php

namespace App\Services;


use App\Models\Province;
use App\Repositories\CityRepository;
use App\Repositories\CountyRepository;
use App\Repositories\ProvinceRepository;

class ProvinceService
{
    /** @var ProvinceRepository $repository */
    protected $repository;

    /** @var CountyRepository $countyRepository */
    protected $countyRepository;

    /** @var CityRepository $cityRepository */
    protected $cityRepository;

    /** @var Province $province */
    protected $province;

    /**
     * ProvinceService constructor.
     *
     * @param  ProvinceRepository  $repository
     * @param  CountyRepository    $countyRepository
     * @param  CityRepository      $cityRepository
     */
    public function __construct(ProvinceRepository $repository, CountyRepository $countyRepository, CityRepository $cityRepository)
    {
        $this->repository       = $repository;
        $this->countyRepository = $countyRepository;
        $this->cityRepository   = $cityRepository;
    }

    /**
     * @param $per_page
     *
     * @return ProvinceRepository[]
     */
    public function provinceList($per_page = null)
    {
        return $this->repository->getAll($per_page);
    }

    /**
     * @param  array  $data
     *
     * @return ProvinceRepository
     */
    public function create(array $data)
    {
        return $this->repository->createNew($data);
    }

    /**
     * @param  array  $data
     */
    public function update(array $data)
    {
        $this->province->update($data);
    }

    /**
     * @throws \Exception
     */
    public function destroy()
    {
        $this->province->delete();
    }

    /**
     * @return array
     */
    public function getCount()
    {
        return [
            'province_count' => $this->repository->getCount(),
            'county_count'   => $this->countyRepository->getCount(),
            'city_count'     => $this->cityRepository->getCount(),
        ];
    }

    /**
     * @return Province
     */
    public function getProvince(): Province
    {
        return $this->province;
    }

    /**
     * @param  Province  $province
     *
     * @return ProvinceService
     */
    public function setProvince(Province $province): ProvinceService
    {
        $this->province = $province;
        return $this;
    }


}
