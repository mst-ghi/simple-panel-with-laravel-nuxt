<?php

namespace App\Models;

use App\Traits\HasStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Code
 *
 * @package App\Models\User
 * @property integer $id
 * @property integer $user_id
 * @property string  $code
 * @property string  $type
 * @property string  $hash
 * @property boolean $status
 * @property Carbon  $expired_at
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 *
 * @property User    $user
 *
 */
class Code extends Model
{
    use HasStatus;

    const TYPE_LOGIN = 'login';
    const TYPE_REGISTER = 'register';
    const TYPE_NOT_SET = 'not-set';

    const TYPES = [
        self::TYPE_LOGIN,
        self::TYPE_REGISTER,
    ];

    protected $table = 'codes';

    protected $fillable = [
        'user_id',
        'code',
        'type',
        'hash',
        'status',
        'expired_at',
    ];

    protected $dates = [
        'expired_at',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generateVerifyCode()
    {
        return mt_rand(1000, 9999);
    }

}
