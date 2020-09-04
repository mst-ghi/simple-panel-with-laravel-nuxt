<?php

namespace App\Services;

use App\Models\Attribute;
use App\Repositories\AttributeGroupRepository;
use App\Repositories\AttributeItemRepository;
use App\Repositories\AttributeRepository;

class AttributeService
{
    /** @var AttributeRepository $repository */
    protected $repository;

    /** @var AttributeGroupRepository $groupRepository */
    protected $groupRepository;

    /** @var AttributeItemRepository $itemRepository */
    protected $itemRepository;

    /** @var Attribute $attribute */
    protected $attribute;

    /**
     * AttributeService constructor.
     *
     * @param  AttributeRepository       $repository
     * @param  AttributeGroupRepository  $groupRepository
     * @param  AttributeItemRepository   $itemRepository
     */
    public function __construct(
        AttributeRepository $repository,
        AttributeGroupRepository $groupRepository,
        AttributeItemRepository $itemRepository
    )
    {
        $this->repository      = $repository;
        $this->groupRepository = $groupRepository;
        $this->itemRepository  = $itemRepository;
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
            'attribute_count'       => $this->repository->getCount(),
            'attribute_group_count' => $this->groupRepository->getCount(),
            'attribute_item_count'  => $this->itemRepository->getCount(),
        ];
    }

    /**
     * @param  array  $data
     *
     * @return AttributeRepository
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
        $this->attribute->update($data);
    }

    /**
     * @throws \Exception
     */
    public function destroy()
    {
        $this->attribute->delete();
    }

    /**
     * @return Attribute
     */
    public function getAttribute(): Attribute
    {
        return $this->attribute;
    }

    /**
     * @param  Attribute  $attribute
     *
     * @return AttributeService
     */
    public function setAttribute(Attribute $attribute): AttributeService
    {
        $this->attribute = $attribute;
        return $this;
    }
}
