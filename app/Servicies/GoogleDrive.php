<?php

namespace App\Servicies;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;

class GoogleDrive {

    private $client;

    public function __construct(Client $client) {

        $this->client = $client;
    }

    public function uploadFile($zipFileName,$access_token){

        $this->client->setAccessToken($access_token);

        $service = new Drive($this->client);
        $file = new DriveFile();

        $service->files->create(
            $file,
            [
                'data' => file_get_contents($zipFileName),
                'mimeType' => 'application/octet-stream',
                'uploadType' => 'multipart'
            ]
        );

    }
}