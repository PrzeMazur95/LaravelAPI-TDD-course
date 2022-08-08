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
        $lists = $this->TodoList::all();

        return response($lists);
    }

    /**
     * @param TodoList $todolist
     *
     * @return Application|ResponseFactory|Response
     */
    public function show(TodoList $todolist)
    {
        return response($todolist);
    }

    public function store(TodoListNameRequiredRequest $request)
    {
        $list = $this->TodoList::create($request->all());
        return response($list, Response::HTTP_CREATED);
    }

    public function destroy(TodoList $list)
    {
        $list->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }

    public function update(Request $request, Todolist $list)
    {
        $list->update($request->all());
        return $list;
    }
}
