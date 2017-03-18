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
		'updated_at',
        'is_read'
    ];


//	public function files(){
//		return $this->hasMany('App\Model\MessageFile','message_id','id');
//	}
	
	
	
	
	public function files(){
	    return $this->belongsToMany('App\Model\File','message_files','message_id','file_id')->withTimestamps();
	}



    public function links(){
        return $this->belongsToMany('App\Model\Link','message_links','message_id','lnk_id')->withTimestamps();
    }



    public function  unreadMessageCount($sender_id)
    {
        return Message::where('is_read',0)->where('sender_id',$sender_id)->count();
    }

}
