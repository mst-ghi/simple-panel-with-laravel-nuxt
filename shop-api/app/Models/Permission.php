<?php

namespace App\Models;

use App\Contracts\Acl\PermissionInterface;
use App\Tools\Acl\PermissionTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 *
 * @package App\Models
 *
 * @property string  $id
 * @property string  $label
 * @property string  $title
 * @property string  $description
 *
 * @property Role[]  $roles
 */
class Permission extends Model implements PermissionInterface
{
    use PermissionTrait;

    protected $table = 'permissions';

    protected $fillable = [
        'label',
        'title',
        'description',
    ];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('acl.permissions_table');
    }

}
