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

    public function test_fetch_all_items_of_a_todo_list()
    {
        //preparation
        $task = Task::factory()->create();
        //action
        $response = $this->get(route('task.index'))->assertOk()->json();
        //assertion
        $this->assertEquals(1, count($response));
        $this->assertEquals($task->title, $response[0]['title']);

    }

    public function test_if_we_could_add_new_task()
    {
        //preparation - below make does not stores task in db, create do
        $task = Task::factory()->make();
        //action
        $this->postJson(route('task.store'), ['title'=> $task->title])
        ->assertCreated();
        //assertion
        $this->assertDatabaseHas('tasks',['title'=> $task->title]);
    }

    public function test_if_we_colud_delete_a_task()
    {
        //preapration
        $task = Task::factory()->create();
        //action
        $this->deleteJson(route('task.destroy', [$task->id]))->assertNoContent();
        //assertion
        $this->assertDatabaseMissing('tasks', ['title' => $task->title]);
    }
}
