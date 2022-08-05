<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class TodoListController extends Controller
{
    private $TodoList;

    /**
     * @param TodoList $TodoList
     */
    public function __construct(TodoList $TodoList)
    {
        $this->TodoList = $TodoList;
    }

    /**
     * @return Application|ResponseFactory|Response
     */
    public function index()
    {
        $lists = $this->TodoList::all();

        return response($lists);
    }

    public function show(TodoList $todolist)
    {
        return response($todolist);
    }
}
