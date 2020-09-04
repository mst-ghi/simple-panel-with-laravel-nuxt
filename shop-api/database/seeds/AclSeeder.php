<?php

use App\Models\User;
use App\Models\Permission;
use App\Models\Role;

class AclSeeder extends DBSeeder
{
    public    $table;
    protected $permission_table;
    protected $permission_role_table;
    protected $roles;
    protected $permissions;

    /**
     * RolePermissionSeeder constructor.
     */
    public function __construct()
    {
        $this->table                 = config('acl.roles_table');
        $this->permission_table      = config('acl.permissions_table');
        $this->permission_role_table = config('acl.permission_role_table');
        $this->permissions           = config('acl.permissions');
        $this->roles                 = config('acl.roles');
    }


    /**
     * Roles
     *
     * @return array()
     */
    public function roles()
    {
        return $this->roles;
    }

    /**
     * Permissions
     *
     * @param  $label
     *
     * @return array|bool|string
     */
    public function permissions($label = '')
    {
        $single = (in_array($label, $this->permissions) ? $label : false);
        return $single;
    }


    /**
     * Run the Seeder
     *
     * @return void
     */
    public function run()
    {
        $this->foreignKeyChecks();
        $this->emptyTable($this->permission_role_table);
        $this->emptyTable($this->permission_table);
        $this->emptyTable($this->table);

        foreach ($this->permissions as $item) {
            $permission        = new Permission();
            $permission->label = $item;
            $permission->title = trans('permissions.' . $item);
            $permission->save();
        }

        foreach ($this->roles() as $key => $val) {
            $this->command->info('Creating/updating the \'' . $key . '\' role');
            $val['label'] = $key;
            $this->reset($val);
        }
    }


    /**
     * Reset Role, Permissions & Users
     *
     * @param  $role
     *
     * @return void
     */
    public function reset($role)
    {
        $commandBullet = '  -> ';

        // The Old Role
        $originalRole = Role::where('label', $role['label'])->first();
        if ($originalRole) Role::where('id', $originalRole->id)->update(['label' => $role['label'] . '__remove']);

        // The New Role
        $newRole        = new Role();
        $newRole->label = $role['label'];
        if (isset($role['title'])) $newRole->title = $role['title'];
        if (isset($role['description'])) $newRole->description = $role['description'];
        if (isset($role['delete_able'])) $newRole->delete_able = $role['delete_able'];
        $newRole->save();
        $this->command->info($commandBullet . "Created $role[label] role");

        // Set the Permissions (if they exist)
        $pcount = 0;
        if (!empty($role['permissions'])) {
            foreach ($role['permissions'] as $permission_label) {

                $permission = $this->permissions($permission_label);
                if ($permission === false || (!$permission_label)) {
                    $this->command->error($commandBullet . "Failed to attach permission '$permission_label'. It does not exist");
                    continue;
                }

                $newPermission = Permission::where('label', $permission_label)->first();

                if (!$newPermission) {
                    $newPermission        = new Permission();
                    $newPermission->label = $permission;
                    if (isset($permission['title'])) $newPermission->title = $permission['title'];
                    if (isset($permission['description'])) $newPermission->description = $permission['description'];
                    $newPermission->save();
                }
                $newRole->attachPermission($newPermission);
                $pcount++;
            }
        }
        $this->command->info($commandBullet . "Attached $pcount permissions to $role[label] role");

        // Update old records
        if ($originalRole) {
            $userCount = 0;
            $RoleUsers = DB::table(config('acl.role_user_table'))->where('role_id', $originalRole->id)->get();
            foreach ($RoleUsers as $user) {
                $u = User::where('id', $user->user_id)->first();
                $u->attachRole($newRole);
                $userCount++;
            }
            $this->command->info($commandBullet . "Updated role attachment for $userCount users");

            Role::where('id', $originalRole->id)->delete(); // will also remove old role_user records
            $this->command->info($commandBullet . "Removed the original $role[label] role");
        }
    }


    /**
     * Cleanup()
     * Remove any roles & permissions that have been removed
     *
     * @return void
     */
    public function cleanup()
    {
        $commandBullet = '  -> ';
        $this->command->info('Cleaning up roles & permissions:');

        $storedRoles = Role::all();
        if (!empty($storedRoles)) {
            $definedRoles = $this->roles();
            foreach ($storedRoles as $role) {
                if (!array_key_exists($role->label, $definedRoles)) {
                    Role::where('label', $role->label)->delete();
                    $this->command->info($commandBullet . 'The \'' . $role->label . '\' role was removed');
                }
            }
        }
        $storedPerms = DB::table(config('acl.permissions_table'))->get();
        if (!empty($storedPerms)) {
            $definedPerms = $this->permissions();
            foreach ($storedPerms as $perm) {
                if (!array_key_exists($perm->label, $definedPerms)) {
                    DB::table(config('acl.permissions_table'))->where('label', $perm->label)->delete();
                    $this->command->info($commandBullet . 'The \'' . $perm->label . '\' permission was removed');
                }
            }
        }
        $this->command->info($commandBullet . 'Done');
        $this->command->info(" ");
    }

    public function __destruct()
    {
        $this->writeln(self::DB_INSERT, "data was added in the \"$this->table\" table");
        $this->writeln(self::DB_INSERT, "data was added in the \"$this->permission_table\" table");
        $this->writeln(self::DB_INSERT, "data was added in the \"$this->permission_role_table\" table");
    }

}
