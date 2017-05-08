<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class CaseTag extends Model
{
    use LogsActivity;

    protected $table = 'case_tag';


    protected $fillable = ['case_id','tag_id','created_at','updated_at'];


    protected static $logAttributes = ['case_id','tag_id','created_at','updated_at'];




}
