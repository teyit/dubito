<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class EvidenceFile extends Model
{
    use LogsActivity;


    protected $table = 'evidence_files';

    protected $fillable = ['id','file_id','evidence_id'];


    protected static $logAttributes = ['file_id','evidence_id'];
}
