<?php

namespace App\Http\Controllers\Dashboard\Attribute\Group;

use App\Http\Controllers\Controller;
use App\Services\AttributeGroupService;

class AttributeGroupController extends Controller
{
    /** @var AttributeGroupService $service */
    protected $service;

    /**
     * AttributeGroupListController constructor.
     *
     * @param AttributeGroupService $service
     */
    public function __construct(AttributeGroupService $service)
    {
        $this->service = $service;
    }
}
