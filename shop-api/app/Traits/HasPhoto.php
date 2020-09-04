<?php
namespace App\Traits;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasPhoto
 *
 * @package App\Traits
 * @property integer $photo_id
 * @property string  $photo_url
 * @property string  $photo_thumbnail_url
 * @property Photo   $photo
 */
trait HasPhoto
{
	public function getPhotoURLAttribute()
	{
		/** @var Photo $photo */
		$photo = $this->photo;

		if ($photo) return $photo->url;

        return $this->defaultNoPhoto ?
            url('') . $this->defaultNoPhoto :
            url('') . '/img/no-image.png';
	}

	public function getPhotoThumbnailUrlAttribute()
	{
		/** @var Photo $photo */
		$photo = $this->photo;

        if ($photo) return $photo->thumbnail;

        return $this->defaultNoThumbnail ?
            url('') . $this->defaultNoThumbnail :
            url('') . '/img/no-thumbnail.png';
	}

	public function photo()
	{
		return $this->belongsTo(Photo::class);
	}

	public function scopePhotoID(Builder $query, int $ID)
	{
		return $query->where('photo_id', $ID);
	}
}
