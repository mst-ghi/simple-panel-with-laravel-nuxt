<?php

namespace App\Services;


use App\Models\City;
use App\Repositories\CityRepository;
use App\Repositories\CountyRepository;
use App\Repositories\ProvinceRepository;

class CityService
{
    /** @var CityRepository $repository */
    protected $repository;

    /** @var ProvinceRepository $provinceRepository */
    protected $provinceRepository;

    /** @var CountyRepository $countyRepository */
    protected $countyRepository;

    /** @var City $city */
    protected $city;

    /**
     * CityService constructor.
     *
     * @param  CityRepository      $repository
     * @param  ProvinceRepository  $provinceRepository
     * @param  CountyRepository    $countyRepository
     */
    public function __construct(CityRepository $repository, ProvinceRepository $provinceRepository, CountyRepository $countyRepository)
    {
        $this->repository         = $repository;
        $this->provinceRepository = $provinceRepository;
        $this->countyRepository   = $countyRepository;
    }

    /**
     * @param $per_page
     *
     * @return CityRepository[]
     */
    public function cityList($per_page = null)
    {
        return $this->repository->getAll($per_page ?? config('paginate.cities'));
    }

    /**
     * @param  int  $county_id
     *
     * @return CityRepository[]
     */
    public function cityShortList(int $county_id)
    {
        return $this->repository->getShortList($county_id);
    }

    /**
     * @param  array  $data
     *
     * @return CityRepository
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
        $this->city->update($data);
    }

    /**
     * @throws \Exception
     */
    public function destroy()
    {
        $this->city->delete();
    }

    /**
     * @return array
     */
    public function getCount()
    {
        return [
            'city_count'     => $this->repository->getCount(),
            'province_count' => $this->provinceRepository->getCount(),
            'county_count'   => $this->countyRepository->getCount(),
        ];
    }

    /**
     * @return City
     */
    public function getCity(): City
    {
        return $this->city;
    }

    /**
     * @param  City  $city
     *
     * @return CityService
     */
    public function setCity(City $city): CityService
    {
        $this->city = $city;
        return $this;
    }


}
