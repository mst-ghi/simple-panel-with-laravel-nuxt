<?php

namespace App\Repositories;

use App\Models\Permission;
use Illuminate\Support\Facades\Cache;

class PermissionRepository extends Permission
{
    public $table = 'permissions';

    /**
     * @return mixed
     */
    public function getList()
    {
        return Cache::remember('getPermissionList', $minute = '30', function (){
            return self::orderBy('label', 'asc')->get();
        });
    }

}
