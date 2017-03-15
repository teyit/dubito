<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $table = 'messages';


	protected $fillable = [
		'report_id',
		'external_message_id',
		'sender_id',
		'recepient_id',
		'source',
		'account_name',
		'account_picture',
		'created_at',
		'updated_at'];


	public function files(){
		return $this->hasMany('App\Model\MessageFile','message_id','id');
	}

}
