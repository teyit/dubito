<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected static function boot()
    {
        parent::boot();

        static::created(function ($message) {

            preg_match_all('/[a-z]+:\/\/\S+/', $message->text, $matches);

            $urls  = array_unique($matches[0]);
            foreach($urls as $l){

                $link = new Link();
                $link->link = $l;
                $link->save();
                $message->links()->attach($link->id);
            }
        });
    }

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
        'is_read',
        'case_id',
        'review_id'
    ];

    protected static $logAttributes = ['report_id','external_message_id','sender_id','recepient_id','source','account_name','account_name','account_picture','created_at','updated_at','is_read'];



    public function files(){
	    return $this->belongsToMany('App\Model\File','message_files','message_id','file_id')->withTimestamps();
	}



    public function links(){
        return $this->belongsToMany('App\Model\Link','message_links','message_id','link_id')->withTimestamps();
    }

    public function report(){
        return $this->belongsTo('App\Model\Report','report_id');
    }


    public function  unreadMessageCount($sender_id)
    {
        return Message::where('is_read',0)->where('sender_id',$sender_id)->count();
    }

}
