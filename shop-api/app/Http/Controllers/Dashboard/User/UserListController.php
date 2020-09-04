<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Requests\Dashboard\User\UserListRequest;
use App\Http\Resources\Dashboard\User\UserListResource;

class UserListController extends UserController
{
    /** @var int $per_page */
    protected $per_page;

    /**
     * @param UserListRequest $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(UserListRequest $request)
    {
        $this->handleQueryParam($request);

        return UserListResource::collection($this->service->getFilteredListUsers($this->per_page));
    }

    /**
     * @param $request
     */
    protected function handleQueryParam($request)
    {
        $this->per_page = $request->get('per_page') ?? null;
    }
}
