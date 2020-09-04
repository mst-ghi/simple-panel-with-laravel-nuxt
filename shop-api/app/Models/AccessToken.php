<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Passport\Client;
use Laravel\Passport\Token;

/**
 * Class AccessToken
 *
 * @package App\Models
 * @property integer $id
 * @property integer $user_id
 * @property integer $client_id
 * @property string  $name
 * @property string  $scopes
 * @property bool    $revoked
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Carbon  $expires_at
 *
 * @property Client  $client
 * @property User    $user
 *
 */
class AccessToken extends Token
{
	protected $table = 'oauth_access_tokens';

	protected $fillable = [
		"user_id",
		"client_id",
		"type",
		"name",
		"scopes",
		"revoked",
		"expires_at",
	];

	protected $dates = [
		"created_at",
		"updated_at",
		"expires_at",
	];
}
