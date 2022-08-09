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
        $this->list = $this->createTodoList(['name' => 'my list']);
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
        $response = $this->getJson(route('todo-list.index'));
        //assertion
        $this->assertCount(1, ($response->json()));
    }

    /**
     * @return void
     */
    public function test_fetch_single_todo_list(): void
    {
        //action
        $response = $this->getJson(route('todo-list.show',$this->list->id));
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
        $list = $this->createTodoList();
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

    public function test_if_we_could_delete_todo_list()
    {

        $this->deleteJson(route('todo-list.destroy', $this->list->id))->assertNoContent();

        $this->assertDatabaseMissing('todo_lists', ['name' => $this->list->name]);
    }

    public function test_if_we_could_update_todo_list()
    {
        $this->patchJson(route('todo-list.update', $this->list->id), ['name' => 'Updated Name'])
        ->assertOk();

        $this->assertDatabaseHas('todo_lists', ['id' => $this->list->id, 'name' => 'Updated Name']);
    }
}
