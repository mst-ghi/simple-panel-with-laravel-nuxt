<?php

namespace App\Models;

use App\Contracts\Acl\RoleInterface;
use App\Tools\Acl\RoleTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @package App\Models\User
 *
 * @property string       $id
 * @property string       $label
 * @property string       $title
 * @property string       $description
 * @property boolean      $delete_able
 *
 * @property Permission[] $permissions
 *
 */
class Role extends Model implements RoleInterface
{
    use RoleTrait;

    protected $fillable = [
        'label',
        'title',
        'description',
        'delete_able'
    ];

    const With = ['admins', 'permissions'];

    /**
     * Creates a new instance of the model.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('acl.roles_table');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(
            config('acl.permission'),
            config('acl.permission_role_table'),
            config('acl.role_foreign_key'),
            config('acl.permission_foreign_key')
        );
    }

}
