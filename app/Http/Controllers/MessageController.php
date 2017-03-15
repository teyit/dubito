<?php

namespace App\Http\Controllers;
use Facebook;

use Illuminate\Http\Request;
use App\Model\Message;
use App\Model\MessageFile;
class MessageController extends Controller
{

    private function getFacebookUser($user_id){
        $fb = new Facebook\Facebook([
            'app_id' => '213471075795721',
            'app_secret' => 'e9040fd795bf94e0053fc2de26f7fdba',
            'default_graph_version' => 'v2.2',
        ]);
        $page_access_token = 'EAADCJpukgwkBAIZB7N4ZBJb7mgif4ZCnK4H3oZAZAkUj7dZA1vteqNLCZBqZAZCu2eVEvc39ywxZByf9nE86N9RCYwjCnm4ZCmNOB4eFFjr84sYsWGoKQHtFs2CN4HOqFCtXOquDfA9vpHgCqIKgtEf8hQXcFVZBnHcLBzGo6ZBqZCpEmoQwZDZD';

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
 
        foreach($request->get('entry') as $e){
            foreach($e['messaging'] as $m){
                $message = Message::where('external_message_id',$m['message']['mid'])->first();
                if($message){
                    return "PASS";
                }
                $facebook_user = $this->getFacebookUser($m['sender']['id']);


                $message = new Message();
                $message->source = 'facebook';
                $message->sender_id = $m['sender']['id'];
                $message->recepient_id = $m['recepient']['id'];
                $message->external_message_id = $m['message']['mid'];
                if($facebook_user){
                    $message->account_name = $facebook_user['account_name'];
                    $message->account_picture = $facebook_user['account_picture'];
                }else{
                    $message->account_name = 'Facebook User';
                    $message->account_picture = '';
                }

                if(isset($m['message']['text'])){
                    $message->text = $m['message']['text'];
                }
                $message->save();
                if(isset($m['message']['attachments'])){
                    foreach($m['message']['attachments'] as $a){
                        $rf = new MessageFile;
                        $rf->message_id= $message->id;
                        $rf->file_type = $a['type'];
                        $rf->file_url = $a['payload']['url'];
                        $rf->save();
                    }
                }

            }

        }
        return "OK";
    }
    public function twitter()
    {
        return "OK";   
    }
}
