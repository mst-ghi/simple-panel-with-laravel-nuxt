<?php

namespace App\Services;

use App\Models\Photo;
use App\Models\Product;
use App\Repositories\AttributeItemRepository;
use App\Repositories\PhotoRepository;
use App\Repositories\ProductRepository;
use App\Tools\Filter\Filter;
use phpDocumentor\Reflection\Types\Boolean;

class ProductService
{
    /** @var ProductRepository $repository */
    protected $repository;

    /** @var PhotoRepository $photoRepository */
    protected $photoRepository;


    protected $itemRepository;

    /** @var Filter $filter */
    protected $filter;

    /** @var Product $product */
    protected $product;

    /** @var Photo $photo */
    protected $photo;

    /** @var array $category_ids */
    protected $category_ids;

    /** @var array $item_ids */
    protected $item_ids;

    /**
     * ProductService constructor.
     *
     * @param  ProductRepository        $repository
     * @param  PhotoRepository          $photoRepository
     * @param  AttributeItemRepository  $itemRepository
     * @param  Filter                   $filter
     */
    public function __construct(
        ProductRepository $repository,
        PhotoRepository $photoRepository,
        AttributeItemRepository $itemRepository,
        Filter $filter
    )
    {
        $this->repository      = $repository;
        $this->photoRepository = $photoRepository;
        $this->itemRepository  = $itemRepository;
        $this->filter          = $filter;
    }

    /**
     * @param $per_page
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredListProducts($per_page)
    {
        return $this->repository->getFilteredList($this->filter, $per_page ?? config('paginate.products'));
    }

    /**
     * @param  array  $data
     * @param  null   $photo
     *
     * @return Product
     * @throws \Exception
     */
    public function create(array $data, $photo = null)
    {
        if ($photo) $this->createPhoto($photo);
        if ($this->photo) $data = array_merge($data, ['photo_id' => $this->photo->id]);
        $this->product = $this->repository->createNew($data);
        $this->syncCategories();
        $this->syncItems();
        return $this->product;

    }

    /**
     * @param  array  $data
     * @param  null   $photo
     *
     * @return Product
     * @throws \Exception
     */
    public function update(array $data, $photo = null)
    {
        if ($photo) $this->createPhoto($photo, $this->product->photo);
        if ($this->photo) $data = array_merge($data, ['photo_id' => $this->photo->id]);
        $this->product->update($data);
        $this->syncCategories();
        $this->syncItems();
        return $this->product;
    }

    /**
     * sync product categories
     */
    public function syncCategories()
    {
        if ($this->category_ids && is_array($this->category_ids))
            $this->product->categories()->sync($this->category_ids);
    }

    /**
     * sync product items
     */
    public function syncItems()
    {
        if ($this->item_ids && is_array($this->item_ids)){
            $this->product->productItems()->delete();
            foreach ($this->item_ids as $id) {
                /** @var AttributeItemRepository $item */
                $item = $this->itemRepository->findOne($id);
                $data = ['attribute_item_id' => $item->id];
                if ($item->attribute) $data = array_merge($data, ['attribute_id' => $item->attribute->id]);
                $this->product->productItems()->create($data);
            }
        }
    }

    /**
     * @param        $photo
     * @param  null  $old_photo
     *
     * @throws \Exception
     */
    public function createPhoto($photo, $old_photo = null)
    {
        $data = [
            'thumbnail' => photoUploader($photo, Photo::TYPE_THUMBNAILS, mt_rand(10, 99)),
            'path'      => photoUploader($photo, Photo::TYPE_PRODUCTS, mt_rand(10, 99)),
            'ext'       => $photo->getClientOriginalExtension(),
        ];

        $this->photo = $this->photoRepository->createNew($data);

        if ($old_photo) $this->photoRepository->destroyPhoto($old_photo);
    }

    /**
     * @return array
     */
    public function getCount()
    {
        return ['product_count' => $this->repository->getCount()];
    }

    /**
     * change product status
     *
     * @param $flag
     */
    public function changeStatus(bool $flag)
    {
        $this->product->update(['status' => $flag]);
    }

    /**
     * @throws \Exception
     */
    public function destroy()
    {
        $this->product->delete();
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param  Product  $product
     *
     * @return ProductService
     */
    public function setProduct(Product $product): ProductService
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return array
     */
    public function getCategoryIds(): array
    {
        return $this->category_ids;
    }

    /**
     * @param  array  $category_ids
     *
     * @return ProductService
     */
    public function setCategoryIds(array $category_ids): ProductService
    {
        $this->category_ids = $category_ids;
        return $this;
    }

    /**
     * @return array
     */
    public function getItemIds(): array
    {
        return $this->item_ids;
    }

    /**
     * @param  array  $item_ids
     *
     * @return ProductService
     */
    public function setItemIds(array $item_ids): ProductService
    {
        $this->item_ids = $item_ids;
        return $this;
    }


}
