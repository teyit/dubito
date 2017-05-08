<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class File extends Model
{
    use LogsActivity;

    protected $table = 'files';

    protected $fillable = ['id','file_url','file_type'];

    protected static $logAttributes = ['file_url','file_type'];

}
