<?php

use App\Http\Controllers\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
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

Route::get('task', [TaskController::class,'index'])->name('task.index');
Route::post('task', [TaskController::class, 'store'])->name('task.store');
Route::delete('task/{task}', [TaskController::class, 'destroy'])->name('task.destroy');