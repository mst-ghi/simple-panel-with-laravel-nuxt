<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Role
     */
    protected $role;

    /**
     * @var array
     */
    protected $data;

    /**
     * custom authenticate wrap method
     *
     * @param null $user
     *
     * @return $this
     */
    protected function userCreate($user = null)
    {
        $this->user = $this->user ?: create('App\Models\User');
        return $this;
    }

    /**
     * @param array $data
     *
     * @return TestCase
     */
    protected function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * attach permission to user
     *
     * @param string $label
     *
     * @return $this
     */
    private function attachPermission(string $label)
    {
        $this->user = $this->user ?: create('App\Models\Admin');
        $this->role  = $this->role ?: create('App\Models\Role');

        $this->role->permissions()->attach([create_permission($label)->id]);
        $this->user->attachRole($this->role->id);

        return $this;
    }

    /**
     * wrap data into data for json request
     *
     * @param $data
     *
     * @return array
     */
    protected function wrapWithData($data)
    {
        return array_wrap_with($data, 'data');
    }
}
