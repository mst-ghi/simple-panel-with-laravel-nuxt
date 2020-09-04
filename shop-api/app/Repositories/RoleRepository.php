<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Support\Facades\Cache;

class RoleRepository extends Role
{
    public $table = 'roles';

    /**
     * @return mixed
     */
    public function getList()
    {
        return Cache::remember('getRoleList', $minute = '30', function (){
            return self::orderBy('id', 'asc')->get();
        });
    }

    /**
     * @param  array  $data
     *
     * @return mixed
     */
    public function storeNew(array $data)
    {
        return self::create($data);
    }

}
