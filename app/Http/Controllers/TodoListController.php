<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodolistRequest;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return auth()->user()->todo_lists;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodolistRequest $request)
    {
       
        return auth()->user()->todo_lists()->create($request->validated());
       
    }

    /**
     * Display the specified resource.
     */
    public function show(TodoList $todo_list)
    {
        //
        return response($todo_list);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TodoList $todo_list)
    {
        //
        $request->validate(["name"=>"required"]);
        return $todo_list->update($request->all());

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
