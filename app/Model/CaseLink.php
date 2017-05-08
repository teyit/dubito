<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class CaseLink extends Model
{
    use LogsActivity;


    protected $table = 'case_links';

    protected $fillable = ['case_id','link_id'];


    protected static $logAttributes = ['case_id','link_id'];


}
