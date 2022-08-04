<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {

        //preparation

        //action
        $response = $this->getJson(route('todo-list'));
        //assertion
        $this->assertCount(1, ($response->json()));
    }
}
