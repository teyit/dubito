<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\Message;
use App\Model\File;
use Illuminate\Support\Facades\Log;
use TwitterStreamingApi;

class TwitterListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listen:twitter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Twitter message listener';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        TwitterStreamingApi::userStream()
            ->onEvent(function(array $event) {
                \Log::info($event);
                if(isset($event['retweeted_status'])){
                    //this is a retweet
                }
                else if(isset($event['direct_message'])){
                    if($event['direct_message']['sender_id'] !== '765187661996883968'){
                        $this->addMessage($event);
                    }
                }

                else if(isset($event['entities']['user_mentions'])){
                    foreach($event['entities']['user_mentions'] as $m){
                        if($m['screen_name'] == 'teyitorg'){ //teyit mentioned but not reply.
                            if( ($event['in_reply_to_screen_name'] == null) || ($event['in_reply_to_screen_name'] == 'teyitorg')){
                                $this->addMention($event);    
                            }
                        }
	                    if($m['screen_name'] !== 'teyitorg' && $event['in_reply_to_screen_name'] == "teyitorg"){ //teyit mentioned but reply.
		                    $this->addMention($event);
	                    }
                    }
                }
            })
            ->startListening();
    }
    private function addMessage($event)
    {
        $dm = $event['direct_message'];
        $message = new Message();
        $message->source = 'twitter:message';
        $message->sender_id = $dm['sender']['id'];
        $message->recipient_id = $dm['recipient']['id'];
        $message->external_message_id = $dm['id'];
        $message->account_name = $dm['sender']['screen_name'];
        $message->account_picture = $dm['sender']['profile_image_url'];


        $text = $dm['text'];


	    $images = [];
        if(isset($dm['entities']['media'])){
            foreach($dm['entities']['media'] as $a){
	            if($a['type'] == 'photo'){
		            $type = 'image';
	            }else{
		            $type = $a['type'];
	            }
                $rf =  File::create([
                    'file_type' => $type,
                    'file_url' => $a['media_url'],
                ]);
	            $text = str_replace($a['url'],'',$text);
	            $images[] = $rf->id;
            }
        }
		$message->text = $text;
	    $message->save();
	    $message->files()->attach($images);

    }
    private function addMention($event)
    {

        $message = new Message();
        $message->source = 'twitter:mention';
        $message->sender_id = $event['user']['id'];
        $message->recipient_id = $event['entities']['user_mentions'][0]['id'];
        $message->external_message_id = $event['id'];
        $message->account_name = $event['user']['screen_name'];
        $message->account_picture = $event['user']['profile_image_url'];

		$text = $event['text'];
        $images = [];
	    if(isset($event['entities']['media'])){
		    foreach($event['entities']['media'] as $a){
			    if($a['type'] == 'photo'){
				    $type = 'image';
			    }else{
				    $type = $a['type'];
			    }
			    $rf =  File::create([
				    'file_type' => $type,
				    'file_url' => $a['media_url'],
			    ]);
			    $text = str_replace($a['url'],'',$text);
			    $images[] = $rf->id;
		    }
	    }
	    $message->text = $text;
	    $message->save();
	    $message->files()->attach($images);


    }


}
