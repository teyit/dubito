<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\Message;
use App\Model\File;
use Illuminate\Support\Facades\Log;
use TwitterStreamingApi;
use Twitter;
class TwitterMentionChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listen:twitterMention';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Twitter mention listener';

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
    public function handle(){
    
        $response = Twitter::getMentionsTimeline([
            'count' => "200", 
        ]);
        foreach($response as $event){
            if(isset($event->{'entities'}->{'user_mentions'})){
                foreach($event->{'entities'}->{'user_mentions'} as $mention){
                    if($mention ->{"screen_name"} == "teyit.org"){
                        if( $event->{'in_reply_to_screen_name'} == null || ($event->{'in_reply_to_screen_name'} === 'teyitorg')){
                        $this -> addMention($event);
                        }
                    }
                    if($mention ->{"screen_name"} !== 'teyitorg' && $event->{'in_reply_to_screen_name'} == "teyitorg"){ //teyit mentioned but reply.
                        $this->addMention($event);
                    }
            }
            }
        }

    }
        private function addMention($event)
    {
        $message = Message::where(["source"=>'twitter:mention',"external_message_id"=>$event->{'id'}]);
        if ($message) {
            return;
        }
        $message = new Message();
        $message->source = 'twitter:mention';
        $message->sender_id = $event->{'user'}->{'id'};
        $message->recipient_id = $event->{'entities'}->{'user_mentions'}[0] ->{'id'};
        $message->external_message_id = $event ->{'id'};
        $message->account_name = $event->{'user'}->{'screen_name'};
        $message->account_picture = $event->{'user'}->{'profile_image_url'};

		$text = $event->{'text'};
        $images = [];
	    if(isset($event->{'entities'}->{'media'})){
		    foreach($event->{'entities'}->{'media'} as $a){
                if($a->{'type'} == 'photo'){
		            $type = 'image';
	            }else{
		            $type = $a->{'type'};
	            }
                $rf =  File::create([
                    'file_type' => $type,
                    'file_url' => $a->{'media_url'}
                ]);
	            $text = str_replace($a->{'url'},'',$text);
	            $images[] = $rf->id;
		    }
	    }
	    $message->text = $text;
	    $message->save();
	    $message->files()->attach($images);


    }
}
