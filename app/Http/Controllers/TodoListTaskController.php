<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListTaskRequest;
use App\Models\TodoList;
use App\Models\TodoListTask;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class TodoListTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TodoList $todo_list)
    {
        //
        $task=$todo_list->tasks;
        return response($task);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoListTaskRequest $request, TodoList $todo_list)
    {
        
        return $todo_list->tasks()->create($request->validated());
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TodoListTaskRequest $request, TodoListTask $task)
    {
        //
        return $task->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TodoListTask $task)
    {
        //
        $task->delete();
        return response("",Response::HTTP_NO_CONTENT);
    }
}
