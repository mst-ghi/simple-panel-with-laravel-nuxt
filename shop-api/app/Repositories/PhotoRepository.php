<?php

namespace App\Repositories;

use App\Models\Photo;

class PhotoRepository extends Photo
{
    protected $table = 'photos';

    /**
     * @param  array  $data
     *
     * @return mixed
     */
    public function createNew(array $data)
    {
        return self::create($data);
    }

    /**
     * @param  Photo  $photo
     *
     * @throws \Exception
     */
    public function destroyPhoto(Photo $photo)
    {
        unlinkPhoto($photo->path);
        unlinkPhoto($photo->thumbnail);

        $photo->delete();
    }
}
