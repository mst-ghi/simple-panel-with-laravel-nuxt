<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends User
{
    protected $table = 'users';

    /**
     * @param string $username
     *
     * @return UserRepository
     */
    public function findByUsername(string $username)
    {
        return self::where('username', $username)->first();
    }

    /**
     * @param  string  $mobile
     *
     * @return UserRepository
     */
    public function findByMobile(string $mobile)
    {
        return self::where('mobile', $mobile)->first();
    }

    /**
     * @param $filter
     * @param $per_page
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredListUsers($filter, $per_page)
    {
        return self::Filter($filter)->orderBy('id', 'desc')->paginate($per_page);
    }

    /**
     * @param  array  $data
     *
     * @return mixed
     */
    public function createNew(array $data)
    {
        /** @var UserRepository $user */
        $user = self::create($data);

        $role = DB::table('roles')
                  ->where('label', '=', self::ROLE_CUSTOMER)
                  ->first();

        if ($role) $user->roles()->sync([$role->id]);

        return $user;
    }

}
