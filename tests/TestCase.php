<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\TodoList;
use App\Models\Task;

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
        
    
}
