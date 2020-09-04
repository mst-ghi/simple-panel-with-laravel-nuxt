<?php

use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

if (!function_exists('getPhotoInfo')) {
    /**
     * @param int $id
     *
     * @return mixed
     */
    function getPhotoInfo(int $id)
    {
        $photo            = Photo::where('id', $id)->first();
        $photo->path      = url('/') . Storage::url($photo->path);
        $photo->thumbnail = url('/') . Storage::url($photo->thumbnail);
        return $photo;
    }
}


if (!function_exists('photoUploader')) {
    /**
     * File uploader
     *
     * @param        $file
     * @param string $type
     * @param int    $int
     * @param null   $oldFile
     *
     * @return string
     */
    function photoUploader($file, string $type, int $int, $oldFile = NULL)
    {
        /** check old file and unlink this */
        if ($oldFile != NULL) {
            unlinkPhoto($oldFile);
        }

        /** choose folder and create it if not available */
        $pathFolder = storage_path("app/public/$type");
        if (!file_exists($pathFolder)) mkdir($pathFolder, 0777, true);

        $str      = date('Y-m-d_H-i-s') . '_' . $int;
        $filename = sha1($str) . '.png';

        exec("find " . $pathFolder . " -type d -exec chmod 0777 {} +");

        if ($type == Photo::TYPE_THUMBNAILS) {
            Image::make($file->getRealPath())->resize(250, 250)->save($pathFolder . '/' . $filename);

        } else {
            Image::make($file->getRealPath())->save($pathFolder . '/' . $filename);

        }

        /** return path of photo */
        return "public/$type/$filename";
    }
}

if (!function_exists('unlinkPhoto')) {
    /**
     * @param string $path
     */
    function unlinkPhoto(string $path)
    {
        if (strpos($path, 'app/') === false) {
            $path = 'app/' . $path;
        }
        if (file_exists(storage_path($path)) && $path != config('path.no-image')) {
            unlink(storage_path($path));
        }
    }
}



