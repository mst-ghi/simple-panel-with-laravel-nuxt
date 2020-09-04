<?php

namespace App\Http\Controllers\Dashboard\Attribute\Attribute;

use App\Http\Controllers\Controller;
use App\Services\AttributeService;

class AttributeController extends Controller
{
    /** @var AttributeService $service */
    protected $service;

    /**
     * AttributeController constructor.
     *
     * @param  AttributeService  $service
     */
    public function __construct(AttributeService $service)
    {
        $this->service = $service;
    }
}
