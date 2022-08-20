<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\TodoList;
use App\Models\Label;
use App\Models\Task;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    public function createTodoList($args = []){
        return $todoList = TodoList::factory()->create($args);
    }

    public function createTask($args = []){
        return $task = Task::factory()->create($args);
    }

    public function createUser($args = []){
        return User::factory()->create($args);
    }

    public function createLabel($args = []){
        return Label::factory()->create($args);
    }

    public function authUser()
    {
        $user = $this->createUser();
        Sanctum::actingAs($user);
        return $user;
    }
        
    
}
