<?php

namespace App\Models;

use App\Tools\Acl\AclUserTrait;
use App\Traits\HasFilter;
use App\Traits\HasPhoto;
use App\Traits\HasStatus;
use App\Traits\JCreatedAt;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 *
 * @package App\Models
 *
 * @property integer   $id
 * @property string    $name
 * @property string    $family
 * @property string    $username
 * @property string    $mobile
 * @property string    $email
 * @property string    $password
 * @property string    $remember_token
 * @property boolean   $status
 * @property Carbon    $email_verified_at
 * @property Carbon    $deleted_at
 * @property Carbon    $created_at
 * @property Carbon    $updated_at
 *
 * @property boolean   $profile
 * @property array     $permissions
 * @property array     $relations
 *
 * @property Code      $code
 * @property Address[] $addresses
 *
 * @method static boolean can(string $method, array $class)
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens, HasPhoto, HasStatus, HasFilter, JCreatedAt, AclUserTrait {
        AclUserTrait::restore as euRestore;
    }

    const ROLE_CUSTOMER = 'customer';

    protected $defaultNoPhoto     = '/img/user.jpg';
    protected $defaultNoThumbnail = '/img/user.jpg';

    protected $fillable = [
        'photo_id',
        'name',
        'family',
        'username',
        'mobile',
        'email',
        'password',
        'remember_token',
        'status',
        'email_verified_at',
        'deleted_at',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $relations = [
        'photo',
    ];

    public function restore()
    {
        $this->sfRestore();
        Cache::tags(config('acl.role_user_table'))->flush();
    }

    public function getPermissionsAttribute()
    {
        return $this->roles[0]->permissions()->select(['label'])->get()->pluck('label');
    }

    public function getProfileAttribute()
    {
        return $this->username && $this->email ?? false;
    }

    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    public function validateForPassportPasswordGrant($password)
    {
        return true;
    }

    public function hasPerm($permission)
    {
        return $this->canUser($permission);
    }

    public function code()
    {
        return $this->hasOne(Code::class, 'user_id');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

}
