<?php

namespace App\Http\Controllers;

use ZipArchive;
use Google\Client;
use App\Models\Service;
use App\Models\TodoListTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\TodoListTaskResource;
use App\Servicies\GoogleDrive;
use App\Servicies\Zipper;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    //
    public const DRIVE_SCOPE = [
        "https://www.googleapis.com/auth/drive",
        "https://www.googleapis.com/auth/drive.file"
    ];

    public function connect(Request $request, Client $client)
    {
        if ($request->name == "google-drive"){

            $client->setScopes(self::DRIVE_SCOPE);
            
            $url = $client->createAuthUrl();
            
            return response(["url"=>$url]);
        }
    }

    public function callback(Request $request, Client $client)
    {
        $access_token = $client->fetchAccessTokenWithAuthCode($request->code);

        $service = Service::create([
            "user_id" => auth()->user()->id,
            "token" => $access_token,
            "name" => "google-drive",
        ]);
        return $service;

    }

    public function store(Service $service, GoogleDrive $drive)
    {
        $tasks = TodoListTask::where("created_at" ,">=", now()->subDays(7))->get();

        $jsonFileName = "task-dump.json";
        Storage::put("public/temp/$jsonFileName",TodoListTaskResource::collection($tasks)->toJson());
        
        $zipFileName = Zipper::createZipFile($jsonFileName);

         
        $access_token= $service->token["access_token"];
        $drive->uploadFile($zipFileName,$access_token);

        // Storage::deleteDirectory("/public/temp");
        return response("Uploaded",Response::HTTP_CREATED);

    }
}
