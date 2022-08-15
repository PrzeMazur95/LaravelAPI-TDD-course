<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskCompletedTest extends TestCase
{
    use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();
        $this->authUser();
    }

    public function test_a_task_can_be_completed()
    {
        $task = $this->createTask();

        $this->patchJson(route('task.update', $task->id), ['status'=>Task::STARTED]);

        $this->assertDatabaseHas('tasks', ['status' => Task::STARTED]);
    }
}
