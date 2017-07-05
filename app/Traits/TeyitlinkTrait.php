<?php

namespace App\Traits;

use AWS;
use App\Model\Link;
trait TeyitlinkTrait
{

    protected static function boot()
    {
        parent::boot();

        static::created(function ($object) {

            $sns = AWS::createClient('sns');
            $text = $object->{$object->teyitlinkColumn};
            preg_match_all('/[a-z]+:\/\/\S+/', $text, $matches);

            foreach($matches[0] as $link){


	            $checkLink = Link::with($object->table)->where('link',$link)->whereHas($object->table,function($query) use ($object){
	                $query->where($object->table . '.id',$object->id);
                })->first();

                if(!$checkLink){
                    $sns->publish(array(
                        'TopicArn' => 'arn:aws:sns:eu-central-1:722509148352:create-new-teyitlink',
                        'Message' => json_encode([
                            'object_id' => $object->id,
	                        'object_type' => $object->table,
	                        'link' => $link
                        ]),
                    ));
                }
            }
        });
    }

}