<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    /** @test */
    public function admin_login_by_correct_username_password()
    {
        $this->setData([
            'username' => $this->user->username,
            'password' => 'secret',
            //                'recaptcha' => 'recaptcha for test',
        ])->userCreate()
            ->postJson(route('auth.login'), $this->data)
            ->assertStatus(200);
    }
}
