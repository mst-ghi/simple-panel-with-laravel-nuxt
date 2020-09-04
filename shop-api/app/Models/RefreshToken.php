<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RefreshToken
 *
 * @package App\Models
 *
 * @property integer $id
 * @property integer $access_token_id
 * @property bool    $revoked
 * @property Carbon  $expires_at
 *
 * @method static Builder TokenID($access_token_id)
 */
class RefreshToken extends Model
{
	protected $table = 'oauth_refresh_tokens';

	protected $fillable = [
		'access_token_id',
		'revoked',
		'expires_at',
	];

	protected $dates = [
		'expires_at',
	];

	// Relations

	// Scopes

	public function scopeTokenID(Builder $query, $ID)
	{
		return $query->where('access_token_id', $ID);
	}
}
