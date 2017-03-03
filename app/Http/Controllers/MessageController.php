<?php

namespace App\Http\Controllers;
use Facebook;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Model\Report;
use App\Model\ReportFile;
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
            $response = $fb->get('/' . $user_id . '?fields=first_name,last_name,profile_pic,locale,timezone,gender', $page_access_token);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        return $response->getGraphUser();
    }
    public function test(){
        dd($this->facebookUser('1672136149469483'));
    }
    public function facebook(Request $request)
    {

        foreach($request->get('entry') as $e){
            foreach($e['messaging'] as $m){
                $report = Report::where('external_message_id',$m['message']['mid'])->first();
                if($report){
                    return "PASS";
                }
                $facebook_user = $this->getFacebookUser($m['sender']['id']);

                $r = new Report();
                $r->source = 'facebook';
                $r->external_user_id = $m['sender']['id'];
                $r->external_message_id = $m['message']['mid'];
                $r->account_name = $facebook_user->getFirstName();
                $r->account_picture= $facebook_user->getPicture();
                $r->status = 'not_resulted';
                if(isset($m['message']['text'])){
                    $r->text = $m['message']['text'];
                }
                $r->save();
                if(isset($m['message']['attachments'])){
                    foreach($m['message']['attachments'] as $a){
                        $rf = new ReportFile;
                        $rf->report_id = $r->id;
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
