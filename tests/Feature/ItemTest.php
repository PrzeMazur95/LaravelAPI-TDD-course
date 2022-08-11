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
}
