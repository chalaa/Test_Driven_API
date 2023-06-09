<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    //
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->all());
        return $user;
    }
}
