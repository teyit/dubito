<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\Message;
use App\Model\File;
use Illuminate\Support\Facades\Log;
use TwitterStreamingApi;
use Twitter;
class TwitterDmChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listen:twitterDM';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Twitter direct message listener';

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
            $response = Twitter::get("direct_messages/events/list.json",[
                'count' => "50", 
            ]);
            $events = ($response->{"events"});
            $receivedOnly=[];
            $newUsers = [];
            foreach($events as $event){
                if($event->{"message_create"} -> {"sender_id"} !=="765187661996883968"){
                    $receivedOnly[] = $event;
                    $newUsers[] = $event->{"message_create"} -> {"sender_id"};
                }
            }
            $newUsers= implode(",",array_unique($newUsers));
            $usersResponse = Twitter:: getUsersLookup(["user_id" => $newUsers ]);
    
            foreach($receivedOnly as $event){
                $this->addMessage($event,$usersResponse);
            }
            return response()->json([
                "users" => $usersResponse,
                'receivedOnly' => $receivedOnly,
            ]);
    
        }
        private function addMessage($event,$users)
        {   
    
            $dm = $event ->{'message_create'};
            $message = Message::firstOrNew(["source"=>'twitter:message',"external_message_id"=>$event->{'id'}]);
            $message->source = 'twitter:message';
            $message->sender_id = $dm->{"sender_id"};
            $message->recipient_id = $dm->{"target"}->{'recipient_id'};
            $message->external_message_id = $event->{'id'};
            foreach($users as $us){
            if($us -> {"id_str"} === $dm->{"sender_id"}){
                $message->account_name = $us -> {"screen_name"};
                $message->account_picture = $us -> {"profile_image_url"};
                }
            }
    
            $text = $dm->{"message_data"}->{'text'};
            $entities = $dm->{"message_data"} ->{"entities"};
            $images = [];
            if(isset($dm->{"message_data"} ->{"attachment"})){
                $a = $dm->{"message_data"} ->{"attachment"}->{"media"};
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
            $message->text = $text;
            
            $message->save();
            $message->files()->attach($images);
    
        }

}
