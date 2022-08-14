<?php

use App\Http\Controllers\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\RegisterController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('todo-list', TodoListController::class);
//it will not show route to show method,
//shallow makes, that only that routes which must have id of list have it like this - todo-list/{todo_list}/task
//so delete and update do not have it
Route::apiResource('todo-list.task', TaskController::class)
    ->except('show')
    ->shallow();
//when you do ot have any function, you can use invoke method, it will call it automatically
Route::post('/register', RegisterController::class)->name('user.register');
