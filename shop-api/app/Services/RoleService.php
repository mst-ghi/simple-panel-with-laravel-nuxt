<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;

class RoleService
{
    /** @var RoleRepository $roleRepository */
    protected $roleRepository;

    /** @var PermissionRepository $permissionRepository */
    protected $permissionRepository;

    /** @var Role $role */
    protected $role;

    /**
     * RoleService constructor.
     *
     * @param  RoleRepository        $roleRepository
     * @param  PermissionRepository  $permissionRepository
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @return mixed
     */
    public function getRoleList()
    {
        return $this->roleRepository->getList();
    }

    /**
     * @return mixed
     */
    public function getPermissionList()
    {
        return $this->permissionRepository->getList();
    }

    /**
     * @return \App\Models\Permission[]
     */
    public function getRolePermissionsList()
    {
        return $this->role->permissions;
    }

    /**
     * @param  array  $permissions
     */
    public function syncRolePermissionList(array $permissions)
    {
        $this->role->permissions()->sync($permissions);
    }

    /**
     * @param  array  $data
     */
    public function store(array $data)
    {
        $this->role = $this->roleRepository->storeNew($data);
    }

    public function update(array $data)
    {
        $this->role->update($data);
    }

    /**
     * @return mixed
     */
    public function getRoleCount()
    {
        return $this->roleRepository->count();
    }

    /**
     * @return mixed
     */
    public function getPermissionsCount()
    {
        return $this->permissionRepository->count();
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @return bool
     */
    public function destroy()
    {
        if ($this->role->delete_able) {
            $this->role->delete();
            return true;
        }
        return false;
    }

    /**
     * @param  Role  $role
     *
     * @return RoleService
     */
    public function setRole(Role $role): RoleService
    {
        $this->role = $role;

        return $this;
    }



}
