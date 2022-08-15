<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_login_with_email_and_password()
    {
        $user = User::factory()->create();

        $response = $this->postJson(route('user.login'),[
            'email' => $user->email,
            'password' => $user->password
        ])->assertOk();

        $this->assertArrayHasKey('token', $response->json());
    }

    public function test_if_user_email_is_not_available_then_it_returns_error()
    {
        $response = $this->postJson(route('user.login'),[
            'email' => 'matheo@gmail.com',
            'password' => 'password'
        ])->assertUnauthorized();
    }
}
