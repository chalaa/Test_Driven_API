<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodolistRequest;
use App\Http\Resources\TodoListResource;
use App\Http\Resources\TodoListTaskResource;
use App\Models\TodoList;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = auth()->user()->todo_lists;
        return TodoListResource::collection($list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodolistRequest $request)
    {
        $todo_list = auth()->user()->todo_lists()->create($request->validated());
        return new TodoListResource($todo_list);
    }

    /**
     * Display the specified resource.
     */
    public function show(TodoList $todo_list)
    {
        //
        return new TodoListResource($todo_list);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TodolistRequest $request, TodoList $todo_list)
    {
        //
        $todo_list->update($request->validated());
        return new TodoListTaskResource($todo_list);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TodoList $todo_list)
    {
        //
        $todo_list->delete();
        return response("",Response::HTTP_NO_CONTENT);
    }
}
