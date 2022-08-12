<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\StoreNewTaskRequest;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    private $task;

    public function __construct(Task $task){
        $this->task = $task;
    }
    public function index()
    {
        $tasks = $this->task::all();
        return response($tasks);
    }

    public function store(StoreNewTaskRequest $request)
    {
        $task = $this->task::create($request->all());
        return $task;
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
