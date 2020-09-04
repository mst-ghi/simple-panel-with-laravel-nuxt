<?php

namespace App\Services;

use App\Models\AttributeItem;
use App\Repositories\AttributeGroupRepository;
use App\Repositories\AttributeItemRepository;
use App\Repositories\AttributeRepository;

class AttributeItemService
{
    /** @var AttributeItemRepository $repository */
    protected $repository;

    /** @var AttributeGroupRepository $groupRepository */
    protected $groupRepository;

    /** @var AttributeRepository $attributeRepository */
    protected $attributeRepository;

    /** @var AttributeItem $attributeItem */
    protected $attributeItem;

    /**
     * AttributeService constructor.
     *
     * @param AttributeItemRepository  $repository
     * @param AttributeGroupRepository $groupRepository
     * @param AttributeRepository      $attributeRepository
     */
    public function __construct(
        AttributeItemRepository $repository,
        AttributeGroupRepository $groupRepository,
        AttributeRepository $attributeRepository
    )
    {
        $this->repository          = $repository;
        $this->groupRepository     = $groupRepository;
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * @param null $per_page
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
            'attribute_group_count' => $this->groupRepository->getCount(),
            'attribute_item_count'  => $this->repository->getCount(),
        ];
    }

    /**
     * @param array $data
     *
     * @return AttributeRepository
     */
    public function create(array $data)
    {
        return $this->repository->createNew($data);
    }

    /**
     * @param array $data
     */
    public function update(array $data)
    {
        $this->attributeItem->update($data);
    }

    /**
     * @throws \Exception
     */
    public function destroy()
    {
        $this->attributeItem->delete();
    }

    /**
     * @return AttributeItem
     */
    public function getAttributeItem(): AttributeItem
    {
        return $this->attributeItem;
    }

    /**
     * @param AttributeItem $attributeItem
     *
     * @return AttributeItemService
     */
    public function setAttributeItem(AttributeItem $attributeItem): AttributeItemService
    {
        $this->attributeItem = $attributeItem;
        return $this;
    }
}
