<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MessageFile extends Model
{
	protected  $table = 'report_files';

	protected $fillable = ['message_id','file_url','file_type'];


	public function message(){
		return $this->belongsTo('App\Model\Message');
	}
}
