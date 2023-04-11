<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TodoListTaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource("todo-list",TodoListController::class);
Route::apiResource("todo-list.task",TodoListTaskController::class)
        ->shallow();


// Route::get("todo-list",[TodoListController::class,"index"])->name("todo-list.index");
// Route::get("todo-list/{todo_list}",[TodoListController::class,"show"])->name("todo-list.show");
// Route::post("todo-list",[TodoListController::class,"store"])->name("todo-list.store");
// Route::delete('todo-list/{todo_list}', [TodoListController::class,"destroy"])->name("todo-list.destroy");
// Route::patch("todo-list/{todo_list}", [TodoListController::class,"update"])->name("todo-list.update");

// Route::get("todo-list-task",[TodoListTaskController::class,"index"])->name("todo_list_task.index");
// Route::post("todo-list-task",[TodoListTaskController::class,"store"])->name("todo_list_task.store");
// Route::delete("todo-list-task/{todo_list_task}",[TodoListTaskController::class,"destroy"])->name("todo_list_task.destroy");