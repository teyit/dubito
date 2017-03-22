<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    protected $table = 'evidences';

    protected $fillable = ['id','text','case_id'];


    public function files(){
        return $this->belongsToMany('App\Model\File','evidence_files','evidence_id','file_id')->withTimestamps();
    }
}


