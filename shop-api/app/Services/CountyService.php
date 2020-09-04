<?php

namespace App\Services;


use App\Models\County;
use App\Repositories\CityRepository;
use App\Repositories\CountyRepository;
use App\Repositories\ProvinceRepository;

class CountyService
{
    /** @var CountyRepository $repository */
    protected $repository;

    /** @var ProvinceRepository $provinceRepository */
    protected $provinceRepository;

    /** @var CityRepository $cityRepository */
    protected $cityRepository;

    /** @var County $county */
    protected $county;

    /**
     * CountyService constructor.
     *
     * @param  CountyRepository    $repository
     * @param  ProvinceRepository  $provinceRepository
     * @param  CityRepository      $cityRepository
     */
    public function __construct(CountyRepository $repository, ProvinceRepository $provinceRepository, CityRepository $cityRepository)
    {
        $this->repository         = $repository;
        $this->provinceRepository = $provinceRepository;
        $this->cityRepository     = $cityRepository;
    }

    /**
     * @param        $per_page
     *
     * @param  null  $province_id
     *
     * @return CountyRepository[]
     */
    public function countyList($per_page = null, $province_id = null)
    {
        return $this->repository->getAll($per_page, $province_id);
    }

    /**
     * @param  array  $data
     *
     * @return CountyRepository
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
        $this->county->update($data);
    }

    /**
     * @throws \Exception
     */
    public function destroy()
    {
        $this->county->delete();
    }

    /**
     * @return array
     */
    public function getCount()
    {
        return [
            'county_count'   => $this->repository->getCount(),
            'province_count' => $this->provinceRepository->getCount(),
            'city_count'     => $this->cityRepository->getCount(),
        ];
    }

    /**
     * @return County
     */
    public function getCounty(): County
    {
        return $this->county;
    }

    /**
     * @param  County  $county
     *
     * @return CountyService
     */
    public function setCounty(County $county): CountyService
    {
        $this->county = $county;
        return $this;
    }


}
