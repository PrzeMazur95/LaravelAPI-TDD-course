<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

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

    public function store()
    {
        $task = $this->task::create(['title'=>'my first task']);
        return $task;
    }
}
