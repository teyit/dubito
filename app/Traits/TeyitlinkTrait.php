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

	        $links = array_unique($matches[0]);
            foreach($links as $link){

                    $sns->publish(array(
                        'TopicArn' => 'arn:aws:sns:eu-central-1:722509148352:create-new-teyitlink',
                        'Message' => json_encode([
                            'object_id' => $object->id,
	                        'object_type' => $object->table,
	                        'link' => $link
                        ]),
                    ));
                
            }
        });
    }

}