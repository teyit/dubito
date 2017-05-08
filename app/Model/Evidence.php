<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Evidence extends Model
{
    use LogsActivity;

    protected $table = 'evidences';

    protected $fillable = ['id','text','case_id','user_id','created_at','updated_at'];


    protected static $logAttributes = ['text','case_id','user_id','created_at','updated_at'];


    protected $dates = ['created_at', 'updated_at'];


    public function files(){
        return $this->belongsToMany('App\Model\File','evidence_files','evidence_id','file_id')->withTimestamps();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}


