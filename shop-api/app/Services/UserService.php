<?php

namespace App\Services;

use App\Models\Photo;
use App\Models\User;
use App\Repositories\PhotoRepository;
use App\Repositories\UserRepository;
use App\Tools\Filter\Filter;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /** @var UserRepository $repository */
    protected $repository;

    /** @var PhotoRepository $photoRepository */
    protected $photoRepository;

    /** @var Filter $filter */
    protected $filter;

    /** @var User $user */
    protected $user;

    /**
     * UserService constructor.
     *
     * @param  UserRepository   $repository
     * @param  PhotoRepository  $photoRepository
     * @param  Filter           $filter
     */
    public function __construct(UserRepository $repository, PhotoRepository $photoRepository, Filter $filter)
    {
        $this->repository = $repository;
        $this->photoRepository = $photoRepository;

        $this->filter = $filter;
    }

    /**
     * @param $per_page
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredListUsers($per_page)
    {
        return $this->repository->getFilteredListUsers($this->filter, $per_page ?? config('paginate.users'));
    }

    /**
     * @param  array   $data
     *
     * @param  string  $password
     *
     * @return User|mixed
     */
    public function create(array $data, string $password)
    {
        $data       = array_merge($data, ['password' => Hash::make($password), 'status' => true]);
        $this->user = $this->repository->createNew($data);
        return $this->user;
    }

    /**
     * @param  array        $data
     *
     *  update user info
     * @param  string|null  $password
     */
    public function update(array $data, string $password = null)
    {
        if ($password) $data = array_merge($data, ['password' => Hash::make($password)]);

        $this->user->update($data);
    }

    /**
     * @param $avatar
     *
     * @return mixed
     */
    public function updateAvatar($avatar)
    {
        /** @var Photo $photo */
        $photo = $this->user->photo;

        if ($photo){
            $thumbnail = $photo->thumbnail;
            $path = $photo->path;
        }

        $data = [
            'thumbnail' => photoUploader($avatar, Photo::TYPE_THUMBNAILS, mt_rand(10, 99), $thumbnail ?? null),
            'path'      => photoUploader($avatar, Photo::TYPE_USERS, mt_rand(10, 99), $path ?? null),
            'ext'       => $avatar->getClientOriginalExtension(),
        ];

        return $this->photoRepository->createNew($data);
    }

    /**
     * @param  int  $role
     */
    public function userRoleSync(int $role)
    {
        $this->user->roles()->sync([$role]);
    }

    /**
     * destroy user
     */
    public function destroyUser()
    {
        $this->user->delete();
    }

    /**
     * @param  User  $user
     *
     * @return UserService
     */
    public function setUser(User $user): UserService
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

}
