<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $list=TodoList::all();
        return response($list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name" => ["required"]
        ]);
       $list= TodoList::create($request->all());
        return $list;
    
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
