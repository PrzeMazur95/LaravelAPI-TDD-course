<?php

namespace Tests\Unit;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_todo_list_can_has_many_tasks()
    {
        $list = $this->createTodoList();
        $task = $this->createTask(['todo_list_id' => $list->id]);

        $this->assertInstanceOf(Collection::class, $list->tasks);
        $this->assertInstanceOf(Task::class, $list->tasks->first());
    }

    public function test_if_todo_list_is_deleted_then_all_tasks_will_be_deleted()
    {
        //preparation
        $list = $this->createTodoList();
        $task = $this->createTask(['todo_list_id' => $list->id]);
        $anotherTask = $this->createTask();
        //action
        $list->delete();
        //assertion
        $this->assertDatabaseMissing('todo_lists', ['id'=> $list->id]);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
        $this->assertDatabaseHas('tasks', ['id' => $anotherTask->id]);

    }
}
