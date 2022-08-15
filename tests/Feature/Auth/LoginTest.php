<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_a_user_can_login_with_email_and_password()
    {
        $response = $this->postJson(route('user.login'),[
            'email' => 'matheo@gmail.com',
            'password' => 'password'
        ])->assertOk();

        $this->assertArrayHasKey('token', $response->json());
    }
}
