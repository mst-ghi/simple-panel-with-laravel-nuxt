<?php

namespace App\Repositories;

use App\Models\Code;

class CodeRepository extends Code
{
    protected $table = 'codes';

    /**
     * @param  int  $user_id
     *
     * @return CodeRepository|null
     */
    public function findByUserId(int $user_id)
    {
        return self::where('user_id', $user_id)->first();
    }

    /**
     * @param  int     $code
     * @param  string  $hash
     *
     * @return CodeRepository|null
     */
    public function findByHashCode(int $code, string $hash)
    {
        return self::where(['hash'=> $hash, 'code'=> $code])->first();
    }

    /**
     * @param  array  $data
     *
     * @return CodeRepository
     */
    public function createNew(array $data)
    {
        return self::create($data);
    }
}
