<?php

namespace App\Http\Controllers;

use App\Http\Requests\LableRequest;
use App\Models\Lable;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return auth()->user()->lable;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LableRequest $request)
    {
        return auth()->user()->lable()->create($request->validated());
        
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
    public function update(LableRequest $request, Lable $lable)
    {
        return $lable->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lable $lable)
    {
        $lable->delete();
        return response("",Response::HTTP_NO_CONTENT);
    }
}
