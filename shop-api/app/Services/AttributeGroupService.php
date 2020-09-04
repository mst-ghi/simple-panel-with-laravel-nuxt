<?php

namespace App\Services;

use App\Models\AttributeGroup;
use App\Repositories\AttributeGroupRepository;
use App\Repositories\AttributeItemRepository;
use App\Repositories\AttributeRepository;

class AttributeGroupService
{
    /** @var AttributeGroupRepository $repository */
    protected $repository;

    /** @var AttributeRepository $attributeRepository */
    protected $attributeRepository;

    /** @var AttributeItemRepository $itemRepository */
    protected $itemRepository;

    /** @var AttributeGroup $attributeGroup */
    protected $attributeGroup;

    /**
     * AttributeGroupService constructor.
     *
     * @param  AttributeGroupRepository  $repository
     * @param  AttributeRepository       $attributeRepository
     * @param  AttributeItemRepository   $itemRepository
     */
    public function __construct(
        AttributeGroupRepository $repository,
        AttributeRepository $attributeRepository,
        AttributeItemRepository $itemRepository
    )
    {
        $this->repository          = $repository;
        $this->attributeRepository = $attributeRepository;
        $this->itemRepository      = $itemRepository;
    }

    /**
     * @param  null  $per_page
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList($per_page = null)
    {
        return $this->repository->getList($per_page);
    }

    /**
     * @return array
     */
    public function getCount()
    {
        return [
            'attribute_count'       => $this->attributeRepository->getCount(),
            'attribute_group_count' => $this->repository->getCount(),
            'attribute_item_count'  => $this->itemRepository->getCount(),
        ];
    }

    /**
     * @param  array  $data
     *
     * @return AttributeGroupRepository
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
        $this->attributeGroup->update($data);
    }

    /**
     * @throws \Exception
     */
    public function destroy()
    {
        $this->attributeGroup->delete();
    }

    /**
     * @return AttributeGroup
     */
    public function getAttributeGroup(): AttributeGroup
    {
        return $this->attributeGroup;
    }

    /**
     * @param  AttributeGroup  $attributeGroup
     *
     * @return AttributeGroupService
     */
    public function setAttributeGroup(AttributeGroup $attributeGroup): AttributeGroupService
    {
        $this->attributeGroup = $attributeGroup;
        return $this;
    }
}
