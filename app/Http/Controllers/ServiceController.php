<?php

namespace App\Http\Controllers;
use App\Model\Cases;
use App\Model\File;
use Facebook;

use Illuminate\Http\Request;
use App\Model\Message;
use App\Model\MessageFile;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{

    private function getFacebookUser($user_id){
        $fb = new Facebook\Facebook([
            'app_id' => '213471075795721',
            'app_secret' => 'e9040fd795bf94e0053fc2de26f7fdba',
            'default_graph_version' => 'v2.2',
        ]);
        $page_access_token = 'EAADCJpukgwkBAE6nD3fdZBGnqwzqB1L4FMYmHeNmiZAKC9mAzGELxdfDzOZAqaL2GuwZA7W86CT6gPA6ls59iy9YMs4ZBMLHKDPefyh4bV25HP4uXdwrbRTItryqU8iE63ybiDZAImYjwMfjFoFYvOM4GrZAtsHfzNlCZA3En7bixAZDZD';

        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->get('/' . $user_id . '?fields=first_name,last_name,profile_pic', $page_access_token);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $result = $response->getGraphUser()->asArray();

        return [
            'account_name' => $result['first_name'] . ' ' . $result['last_name'],
            'account_picture' => $result['profile_pic']
        ];
    }

    public function facebook(Request $request)
    {
        \Log::info('start');
        if($request->has('hub_challenge')){
            return $request->get('hub_challenge');
        }

        $entries = $request->get('entry');


        if(!is_array($entries)){
            return "EMPTY";
        }

        \Log::info($entries);


        foreach($request->get('entry') as $e){
            foreach($e['messaging'] as $m){
                $message = Message::where('external_message_id',$m['message']['mid'])->where('source','facebook:message')->first();
                if($message){
                    \Log::info("pass");

                    return "PASS";
                }
                $facebook_user = $this->getFacebookUser($m['sender']['id']);

                \Log::info("facebook user-",$facebook_user);


                $message = new Message();
                $message->source = 'facebook:message';
                $message->sender_id = $m['sender']['id'];
                $message->recipient_id = $m['recipient']['id'];
                $message->external_message_id = $m['message']['mid'];
                if($facebook_user){
                    moveToS3Link("facebook/account/",$m['sender']['id'],$facebook_user['account_picture']);
                    $message->account_name = $facebook_user['account_name'];
                    $message->account_picture = Storage::disk('s3')->get("facebook/account/".$m['sender'['id'].'.jpg']);
                }else{
                    $message->account_name = 'Facebook User';
                    $message->account_picture = '';
                }

                if(isset($m['message']['text'])){
                    $message->text = $m['message']['text'];
                }
                $message->save();
                if(isset($m['message']['attachments'])){
                    \Log::info("message");
                    foreach($m['message']['attachments'] as $a){

                        if($a['type'] == 'fallback'){
                            $message->text = $message->text . " " . $a['url'];
                            $message->save();
                        }else{
                            \Log::info("atachment");



                           $rf =  File::create(
                                ['file_type' => $a['type'],
                                 'file_url' => $a['payload']['url'],
                            ]);

                            $message->files()->attach($rf->id);
                        }

                    }
                }

            }

        }
        return "OK";
    }


}
