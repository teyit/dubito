<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ReportFile extends Model
{
    use LogsActivity;


    protected  $table = 'report_files';

    protected $fillable = ['report_id','file_id'];

    protected static $logAttributes = ['report_id','file_id'];



    public function report(){
        return $this->belongsTo('App\Model\Report');
    }
}
