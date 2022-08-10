<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemTest extends TestCase
{
    public function test_fetch_all_items_of_a_todo_list()
    {
        //preparation
        Task::factory()->create();
        //action
        $response = $this->get(route('task.index'))->assertOk()->json();
        //assertion
        $this->assertEquals(1, count($response));

    }
}
