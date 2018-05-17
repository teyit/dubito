<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class MessageTemplate extends Model
{
    use LogsActivity;

	protected  $table = 'message_templates';

	protected $fillable = ['id','text','created_at','updated_at'];

    protected static $logAttributes = ['id','file_id','created_at','updated_at'];

}
