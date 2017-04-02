<?php
/**
 * Created by PhpStorm.
 * User: onerciller
 * Date: 01/04/17
 * Time: 18:23
 */

namespace App\Libraries\Google;


use Illuminate\Support\Facades\Session;

class GoogleDocument
{
    const BASE_URL = "https://docs.google.com/document/d";


    //https://docs.google.com/document/d/1ThwbaviIu8BtWNu4nrMMovjfF86cN85Kx8x5BAXRFHQ/edit

    public static function createNewDocument($title){
        $code = \Illuminate\Support\Facades\Session::get('code');
        $client = new \Google_Client();
        $client->setAuthConfig(storage_path().'/google/credential.json');
        $client->addScope(\Google_Service_Drive::DRIVE);
        $client->setRedirectUri(route('social.handle','google'));

        $auth_url  = $client->createAuthUrl();



        $client->authenticate($code);

        $accessToken = $client->getAccessToken();


        $client->setAccessToken($accessToken);

        $service = new \Google_Service_Drive($client);

        $fileMetadata = new \Google_Service_Drive_DriveFile(array(
            'name' =>$title,
            'mimeType' => 'application/vnd.google-apps.document'));
        $file = $service->files->create($fileMetadata, array(
            'fields' => 'id'));

        return $file->id;
    }
}