<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';


    protected $fillable = ['title','case_id','source','created_at','updated_at'];


    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }


    public function reportfiles(){
        return $this->hasMany('App\Model\ReportFile','report_id','id');
    }

    public function cases(){
        return $this->belongsTo('App\Model\Cases','case_id','id');
    }
}
