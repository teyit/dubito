<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class CaseFile extends Model
{
    use LogsActivity;

    protected $table = 'case_files';


    protected $fillable = ['case_id','file_id'];


    protected static $logAttributes = ['case_id','file_id'];



}
