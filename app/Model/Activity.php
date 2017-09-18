<?php

namespace App\Model;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Activity extends Model
{
     


    protected $table = 'case_activities';

    protected $fillable = ['case_id','user_id','text'];


    protected static $logAttributes = ['case_id','user_id','text'];
    public function user(){
    	return $this->belongsTo(User::class);
    }

}
