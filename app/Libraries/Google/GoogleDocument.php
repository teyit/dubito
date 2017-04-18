<?php
/**
 * Created by PhpStorm.
 * User: onerciller
 * Date: 01/04/17
 * Time: 18:23
 */

namespace App\Libraries\Google;


use App\User;
use Illuminate\Support\Facades\Session;

class GoogleDocument
{

    public static function createNewDocument(){

        $client = new \Google_Client();

        $user = User::find(15);

        $client->setAccessToken($user->token);

        $service = new \Google_Service_Drive($client);

        $fileMetadata = new \Google_Service_Drive_DriveFile(array(
            'name' =>'title',
            'mimeType' => 'application/vnd.google-apps.document'));
        $file = $service->files->create($fileMetadata, array(
            'fields' => 'id'));

        return $file->id;

    }
}