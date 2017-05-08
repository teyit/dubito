<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class MessageFile extends Model
{
    use LogsActivity;

	protected  $table = 'message_files';

	protected $fillable = ['message_id','file_id'];

    protected static $logAttributes = ['message_id','file_id'];


    public function message(){
		return $this->belongsTo('App\Model\Message');
	}
}
