<?php

namespace Tests\Unit;

use App\Models\TodoList;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_many_todo_list()
    {
        $user = $this->createUser();
        $list = $this->createTodoList(['user_id' => $user->id]);

        $this->assertInstanceOf(TodoList::Class, $user->todo_lists->first());

    }
}
