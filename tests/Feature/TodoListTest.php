<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_fetch_all_todo_list(): void
    {
        //preparation
        TodoList::factory()->create(['name' => 'my list']);
        //action
        $response = $this->getJson(route('todo-list'));
        //assertion
        $this->assertCount(1, ($response->json()));
    }

    public function test_fetch_single_todo_list()
    {
        //preparation
        $list = TodoList::factory()->create();
        //action
        $response = $this->getJson(route('todo-list.show',$list->id));
        //assertion
        $response->assertstatus(200);
        $this->assertEquals($response->json()['name'], $list->name);
    }
}
