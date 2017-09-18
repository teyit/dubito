<?php

namespace App\Model;

use App\User;
use App\Model\Link;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Evidence extends Model
{
    use LogsActivity;
    
    protected $with = ['links'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($evidence) {

            preg_match_all('/[a-z]+:\/\/\S+/', $evidence->text, $matches);

            $urls  = array_unique($matches[0]);

            foreach($urls as $l){

                $link = new Link();
                $link->link = $l;
                $link->save();
                $evidence->links()->attach($link->id);
            }
        });
    }

    protected $table = 'evidences';

    protected $fillable = ['id','text','case_id','user_id','created_at','updated_at'];


    protected static $logAttributes = ['text','case_id','user_id','created_at','updated_at'];


    protected $dates = ['created_at', 'updated_at'];

    public function links(){
        return $this->belongsToMany('App\Model\Link','evidence_links','evidence_id','link_id')->withTimestamps();
    }

    public function files(){
        return $this->belongsToMany('App\Model\File','evidence_files','evidence_id','file_id')->withTimestamps();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}


