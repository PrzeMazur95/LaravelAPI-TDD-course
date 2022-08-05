<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListTest extends TestCase
{

    use RefreshDatabase;

    private $list;
    public function setUp(): void
    {
        parent::setUp();
        $this->list = TodoList::factory()->create(['name' => 'my list']);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_fetch_all_todo_list(): void
    {
        //action
        $response = $this->getJson(route('todo-list'));
        //assertion
        $this->assertCount(1, ($response->json()));
    }

    public function test_fetch_single_todo_list()
    {
        //action
        $response = $this->getJson(route('todo-list.show',$this->list->id));
        //assertion
        $response->assertstatus(200);
        $this->assertEquals($response->json()['name'], $this->list->name);
    }
}
