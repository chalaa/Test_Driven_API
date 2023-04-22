<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\TodoListTask;
use App\Http\Requests\TodoListTaskRequest;
use App\Http\Resources\TodoListResource;
use App\Http\Resources\TodoListTaskResource;
use Symfony\Component\HttpFoundation\Response;

class TodoListTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TodoList $todo_list)
    {
        //
        $task=$todo_list->tasks;
        return TodoListTaskResource::collection($task);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoListTaskRequest $request, TodoList $todo_list)
    {
        
        $task = $todo_list->tasks()->create($request->validated());
        return new TodoListTaskResource($task);
        
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
        $task->update($request->validated());
        return new TodoListTaskResource($task);
    
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
