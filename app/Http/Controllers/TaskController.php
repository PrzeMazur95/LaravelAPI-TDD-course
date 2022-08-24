<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Label;
use App\Http\Requests\StoreNewTaskRequest;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    private $task;

    public function __construct(Task $task){
        $this->task = $task;
    }
    public function index(TodoList $todo_list)
    {
        $tasks = $todo_list->tasks;;
        return response($tasks);
    }

    public function store(StoreNewTaskRequest $request, TodoList $todo_list, Label $label)
    {
        // dd($request->validated());
       return $task = $todo_list->tasks()->create($request->all());
//        $request['todo_list_id'] = $todo_list->id;
//        $task = $this->task::create($request->all());
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response('',Response::HTTP_NO_CONTENT);
    }

    public function update(Task $task, Request $request)
    {
        $task->update($request->all());
        return response ($task);
    }
}
