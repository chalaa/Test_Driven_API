<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    //

    public function __invoke(LoginRequest $request)
    {
        $user = User::where(["email" => $request->email])->first();
        if(! $user ||  !Hash::check($request->password,$user->password)){
            return response(["token"=>"Credentials not found"], Response::HTTP_UNAUTHORIZED);
        }
        
        $token = $user->createToken("api_test");

        return response(
        [
            "token"=> $token->plainTextToken
        ]);
        
    }

}
