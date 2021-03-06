<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Report extends Model
{
    use LogsActivity;
    protected $table = 'reports';

    protected static function boot()
    {
        parent::boot();

        static::created(function ($report) {

            preg_match_all('/[a-z]+:\/\/\S+/', $report->text, $matches);

            $urls  = array_unique($matches[0]);
            foreach($urls as $l){

                $link = new Link();
                $link->link = $l;
                $link->save();
                $report->links()->attach($link->id);
            }
        });
    }

    protected $fillable = ['text','case_id','source','external_message_id','external_user_id','account_name','account_picture','folder','phone','created_at','updated_at'];

    protected static $logAttributes = ['text','case_id','source','external_message_id','external_user_id','account_name','account_picture','created_at','updated_at'];


    public function images(){
        return $this->hasMany('App\Model\ReportFile','report_id','id');
        //TODO WHERE.
    }


    public function case(){
        return $this->belongsTo('App\Model\Cases','case_id','id');
    }


    public function files(){
        return $this->belongsToMany('App\Model\File','report_files','report_id','file_id')->withTimestamps();
    }


    public function links(){
        return $this->belongsToMany('App\Model\Link','report_links','report_id','link_id')->withTimestamps();
    }


    public function fileTypeCount()
    {
        return $this->belongsToMany('App\Model\File','report_files','report_id','file_id')
            ->selectRaw('count(*)')
            ->groupBy('file_type');
    }


}
