<?php

use Google\Client;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $service = Service::find(2)->get();
    return $service[0]["token"];
});


Route::get("/drive", function(){
    
});

Route::get("/google-drive/callback", function(Request $request, Client $client){
   return request("code");
//    $access_token = $client->fetchAccessTokenWithAuthCode($request->code);

//         $service = Service::create([
//             "user_id" => auth()->user()->id,
//             "token" => json_encode(["access_token"=>$access_token]),
//             "name" => "google-drive",
//         ]);
//         return $service;
});

Route::get("/upload", function(){
    
});
