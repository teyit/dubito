<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReportFile extends Model
{
    protected  $table = 'report_files';

    protected $fillable = ['report_id','file_url','file_type','category_id'];


    public function report(){
        return $this->belongsTo('App\Model\Report');
    }
}
