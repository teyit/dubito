<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';



    protected $fillable = ['text','case_id','source','external_message_id','external_user_id','account_name','account_picture','status','created_at','updated_at'];


    public function images(){
        return $this->hasMany('App\Model\ReportFile','report_id','id');
        //TODO WHERE.
    }


//    public function reportfiles(){
//        return $this->hasMany('App\Model\ReportFile','report_id','id');
//    }

    public function case(){
        return $this->belongsTo('App\Model\Cases','case_id','id');
    }


    public function files(){
        return $this->belongsToMany('App\Model\File','report_files','report_id','file_id')->withTimestamps();
    }


    public function links(){
        return $this->belongsToMany('App\Model\Link','report_links','report_id','link_id')->withTimestamps();
    }

}
