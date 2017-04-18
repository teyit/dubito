<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    protected $table = 'cases';

    protected $fillable = ['title','user_id','topic_id','description','category_id','created_at','updated_at','google_document_id'];

    protected $dates = ['created_at', 'updated_at'];

    public function setGoogleDocument(){
        if($this->google_document_id){
            return $this->google_document_id;
        }
        $client = new \Google_Client();

        $dubito_folder_id = '0B3svx2NH-juvNW81V2pzajRvRWM';

        $token = User::find(15)->token; //TODO fix better.

        $client->setAccessToken($token);

        $service = new \Google_Service_Drive($client);

        $fileMetadata = new \Google_Service_Drive_DriveFile([
            'name' => 'Case ' . $this->id,
            'parents' =>   [$dubito_folder_id],
            'mimeType' => 'application/vnd.google-apps.document'
        ]);
        $file = $service->files->create($fileMetadata, [
            'fields' => 'id'
        ]);
        $this->google_document_id = $file->id;
        return $file->id;
    }
    public function topic(){
      return $this->belongsTo(Topic::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function reports(){
        return $this->hasMany('App\Model\Report','case_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function tags(){
        return $this->belongsToMany('App\Model\Tag','case_tags','case_id','tag_id');
    }

    public function evidences(){
        return $this->hasMany('App\Model\Evidence','case_id','id');
    }


    public function files(){
        return $this->belongsToMany('App\Model\File','case_files','case_id','file_id')->withTimestamps();
    }


    public function links(){
        return $this->belongsToMany('App\Model\Link','case_links','case_id','link_id')->withTimestamps();
    }

}
