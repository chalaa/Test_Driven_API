<?php

namespace App\Servicies;

use ZipArchive;

class Zipper {

    public static function createZipFile($fileName){

        $zip = new ZipArchive();
        $zipFileName = storage_path("/app/public/temp/" .now()->timestamp ."-task.zip");
 
        if($zip->open($zipFileName, ZipArchive::CREATE)){
            $zipFilePath = storage_path("app/public/temp/".$fileName);
            $zip->addFile($zipFilePath,$fileName);
        }
        $zip->close();

        return $zipFileName;
       
    }
}