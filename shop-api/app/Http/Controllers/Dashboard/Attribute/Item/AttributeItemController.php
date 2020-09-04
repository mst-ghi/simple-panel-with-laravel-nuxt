<?php

namespace App\Http\Controllers\Dashboard\Attribute\Item;

use App\Http\Controllers\Controller;
use App\Services\AttributeItemService;

class AttributeItemController extends Controller
{
    /** @var AttributeItemService $service */
    protected $service;

    /**
     * AttributeItemController constructor.
     *
     * @param AttributeItemService $service
     */
    public function __construct(AttributeItemService $service)
    {
        $this->service = $service;
    }
}
