<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    protected $table = 'evidences';

    protected $fillable = ['id','text','case_id','user_id'];

    protected $dates = ['created_at', 'updated_at'];


    public function files(){
        return $this->belongsToMany('App\Model\File','evidence_files','evidence_id','file_id')->withTimestamps();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}


