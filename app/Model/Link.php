<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use AWS;
class Link extends Model
{
    protected $table ='links';

    protected $fillable = ['id','link','meta_title','meta_description','image','teyitlink_slug','archiveis_link','created_at','updated_at'];

    protected static $logAttributes = ['link','created_at','updated_at'];


    public function messages(){
        return $this->belongsToMany('App\Model\Message','message_links','link_id','message_id')->withTimestamps();
    }
    public function getTeyitlinkAttribute(){
        return "http://teyit.link/" . $this->attributes['teyitlink_slug'];
    }
    protected static function boot()
    {
        parent::boot();
        static::created(function ($link) {
            $sns = AWS::createClient('sns');
            $sns->publish(array(
                'TopicArn' => 'arn:aws:sns:eu-central-1:722509148352:create-new-teyitlink',
                'Message' => json_encode($link),
            ));
        });
    }
}
