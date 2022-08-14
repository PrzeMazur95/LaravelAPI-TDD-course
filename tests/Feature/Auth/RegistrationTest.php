<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use refreshDatabase;

    public function test_user_can_register()
    {
        $this->postJson(route('user.register',['name'=>'Matheo', 
        'email'=>'Matheo@gmail.com', 
        'password' => 'secret2123',
        'password_confirmation' => 'secret2123'
        ]))->assertCreated();
        $this->assertDatabaseHas('users', ['name'=>'Matheo']);
    }
}
