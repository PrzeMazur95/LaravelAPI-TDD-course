<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use App\Http\Requests\TodoListNameRequiredRequest;

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
        $lists = auth()->user()->todo_lists;

        return response($lists);
    }

    /**
     * @param TodoList $todolist
     *
     * @return Application|ResponseFactory|Response
     */
    public function show(TodoList $todo_list)
    {
        return response($todo_list);
    }

    public function store(TodoListNameRequiredRequest $request)
    {
        return auth()->user()->todo_lists()->create($request->validated());

    }

    public function destroy(TodoList $todo_list)
    {
        $todo_list->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }

    public function update(TodoListNameRequiredRequest $request, Todolist $todo_list)
    {
        $todo_list->update($request->all());
        return $todo_list;
    }
}
