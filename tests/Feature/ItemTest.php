<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use App\Http\Controllers\TaskController;

class ItemTest extends TestCase
{
    //runs db migrations before every test
    use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();
        $this->authUser();
    }

    public function test_fetch_all_items_of_a_todo_list()
    {
        //preparation
        $list = $this->createTodoList();
        $label = $this->createLabel();
        $task = $this->createTask(['todo_list_id' => $list->id, 'label_id'=>$label->id]);
        //action
        $response = $this->get(route('todo-list.task.index', $list->id))->assertOk()->json();
        //assertion
        $this->assertEquals(1, count($response));
        $this->assertEquals($task->title, $response[0]['title']);
        $this->assertEquals($response[0]['todo_list_id'], $list->id);

    }

    public function test_if_we_could_add_new_task()
    {
        //preparation - below make does not stores task in db, create do
        $task = Task::factory()->make();
        $list = $this->createTodoList();
        $label=$this->createLabel();
        //action
        $this->postJson(route('todo-list.task.store', [$list->id]), ['title'=> $task->title, 'label_id'=>$task->label_id])
        ->assertCreated();
        //assertion
        $this->assertDatabaseHas('tasks',[
            'title'=> $task->title,
            'todo_list_id' => $list->id,
            'label_id' => $task->label_id
        ]);
    }

    public function test_if_we_colud_delete_a_task()
    {
        //preapration
        $task = $this->createTask();
        //action
        $this->deleteJson(route('task.destroy', [$task->id]))->assertNoContent();
        //assertion
        $this->assertDatabaseMissing('tasks', ['title' => $task->title]);
    }

    public function test_if_we_could_update_a_task()
    {
        //preparation
        $task = $this->createTask();
        //action
        $this->patchJson(route('task.update', $task->id), ['title' => 'updated title'])->assertOk();
        //assertion
        $this->assertDatabaseHas('tasks', ['title' => 'updated title']);
    }
}
