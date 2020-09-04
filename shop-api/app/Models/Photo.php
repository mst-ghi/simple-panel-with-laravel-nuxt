<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class Photo
 *
 * @package App\Models
 *
 * @package App\Models\Common
 * @property integer $id
 * @property string  $disk
 * @property string  $path
 * @property string  $thumbnail
 * @property string  $ext
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 *
 * Appends:
 * @property string  $url
 * @property string  $thumbnail_url
 */
class Photo extends Model
{
    const DISK_LOCAL = 'local';

    const TYPE_THUMBNAILS = 'thumbnails';
    const TYPE_USERS      = 'users';
    const TYPE_BRANDS     = 'brands';
    const TYPE_PRODUCTS   = 'products';
    const TYPE_BANNERS    = 'banners';

    protected $type;

    /** @var array */
    protected $fillable = [
        'disk',
        'path',
        'thumbnail',
        'ext',
    ];

    protected $appends = [
        'url',
        'thumbnail_url',
    ];

    public function getUrlAttribute()
    {
        $this->type = 'path';
        return $this->getPhotoUrl();
    }

    public function getThumbnailUrlAttribute()
    {
        $this->type = 'thumbnail';
        return $this->getPhotoUrl();
    }

    public function getPhotoUrl()
    {
        if ($this->checkExistPhoto()) {

            if ($this->isLocalDisk())
                return url('/') . Storage::url($this->getPhotoPath());

            return Storage::disk($this->disk)->url($this->getPhotoPath());

        }

        return null;
    }

    public function isLocalDisk()
    {
        return $this->disk == self::DISK_LOCAL ? true : false;
    }

    public function checkExistPhoto()
    {
        return Storage::disk($this->disk)->exists($this->getPhotoPath()) ? true : false;
    }

    public function getPhotoPath()
    {
        if ($this->type == 'path') return $this->path;
        elseif ($this->type == 'thumbnail') return $this->thumbnail;
        return null;
    }
}
