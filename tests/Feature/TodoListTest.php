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
     * @test
     */
    public function fetch_all_todo_list(): void
    {
        //action
        $response = $this->getJson(route('todo-list'));
        //assertion
        $this->assertCount(1, ($response->json()));
    }

    /**
     * @return void
     */
    public function test_fetch_single_todo_list(): void
    {
        //action
        $response = $this->getJson(route('todo-list.show', $this->list->id));
        //assertion
        $response->assertstatus(200);
        $this->assertEquals($response->json()['name'], $this->list->name);
    }

    /**
     * @return void
     */
    public function test_store_new_todo_list(): void
    {
        //preparation
        $list = TodoList::factory()->make();
        //action
        $response = $this->postJson(route('todo-list.store', ['name' => $list->name]))->assertCreated()->json();
        //assertion
        $this->assertEquals($list->name, $response['name']);
        $this->assertDatabaseHas('todo_lists', ['name' => $list->name]);
    }

    public function test_while_storing_todo_list_name_field_is_required()
    {
        $this->withExceptionHandling();
        $response = $this->postJson(route('todo-list.store'))
        ->assertStatus(422)
        ->assertJsonValidationErrors(['name']);
    }
}
