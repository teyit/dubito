<?php
/**
 * Created by PhpStorm.
 * User: onerciller
 * Date: 21/04/17
 * Time: 23:02
 */

namespace App\Traits;


use App\Model\Cases;
use App\User;
use Illuminate\Support\Facades\Auth;

trait GoogleCreateDocumentTrait
{

    protected static function boot()
    {
        parent::boot();

        static::created(function (Cases $case) {


            list($user, $domain) = explode('@', $case->user->email);

            if ($domain == 'teyit.org') {

                if ($case->google_document_id) {
                    return $case->google_document_id;
                }
                $client = new \Google_Client();

                $dubito_folder_id = '0B3svx2NH-juvNW81V2pzajRvRWM';


                $token = User::where('email', 'info@teyit.org')->first()->token;

                $client->setAccessToken($token);

                $service = new \Google_Service_Drive($client);

                $fileMetadata = new \Google_Service_Drive_DriveFile([
                    'name' => 'Case ' . $case->id,
                    'parents' => [$dubito_folder_id],
                    'mimeType' => 'application/vnd.google-apps.document'
                ]);

                $file = $service->files->create($fileMetadata, [
                    'fields' => 'id'
                ]);

                $case->google_document_id = $file->id;
                $case->save();
            }


        });
    }

}