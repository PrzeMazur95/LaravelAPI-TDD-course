<?php

namespace Tests\Unit;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_belongs_to_a_todo_list()
    {
        $list = $this->createTodoList();
        $label = $this->createLabel();
        $task = $this->createTask(['todo_list_id' => $list->id, 'label_id' =>$label->id]);

        $this->assertInstanceOf(TodoList::class, $task->todo_list);
    }
}
