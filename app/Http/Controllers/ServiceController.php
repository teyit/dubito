<?php

namespace App\Http\Controllers;
use App\Model\Cases;
use App\Model\Link;
use App\Model\File;
use Facebook;

use Illuminate\Http\Request;
use App\Model\Message;
use App\Model\MessageFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{

    private function getFacebookUser($user_id){
        $fb = new Facebook\Facebook([
            'app_id' => env('FB_APP_ID', null),
            'app_secret' => env('FB_APP_SECRET', null),
            'default_graph_version' => 'v2.2',
        ]);

        $page_access_token = env('FB_PAGE_ACCESS_TOKEN', null);

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
    public function RequestArchieveIsLink($url){
        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST =>  1,
            CURLOPT_HTTPHEADER=> array('Content-Type: application/x-www-form-urlencoded'),
            CURLOPT_POSTFIELDS => "url=".$url,
            CURLOPT_URL => 'http://archive.is/submit/',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));

        curl_exec($ch);
        $redir = curl_getinfo($ch, CURLINFO_REDIRECT_URL);

        curl_close($ch);

        return explode("/",$redir);

    }
    public function teyitlink(Request $request){

        $body = json_decode($request->getContent());
        if(!isset($body->Message)){
            return "FAIL";
        }
        $message = json_decode($body->Message);
        $result = $message->result;

        if(!isset($result->status)){
            return "CREATE FAIL";
        }

        $data = $result->data;

        $link = Link::find($message->payload->id);

        if(isset($data->slug)){
            $link->teyitlink_slug = $data->slug;
        }
        if(isset($data->meta_title)){
            $link->meta_title = $data->meta_title;
        }
        if(isset($data->meta_description)){
            $link->meta_description = $data->meta_description;
        }
        if(isset($data->image)){
            $link->image = $data->image;
        }
        $archiveIsLink = $this->RequestArchieveIsLink($link->link);
        if(count($archiveIsLink)>=4){
            $link->archiveis_link = $archiveIsLink[3];
        }
        $link->save();

        return "OK";

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
            foreach($e['messaging'] as $m) {
	            $message = Message::where('external_message_id', $m['message']['mid'])->where('source', 'facebook:message')->first();
	            if ($message) {
		            \Log::info("pass");
		            return "PASS";
	            }
	            $facebook_user = $this->getFacebookUser($m['sender']['id']);

	            \Log::info("facebook user-", $facebook_user);


	            $message = new Message();
	            $message->source = 'facebook:message';
	            $message->sender_id = $m['sender']['id'];
	            $message->recipient_id = $m['recipient']['id'];
	            $message->external_message_id = $m['message']['mid'];
	            if ($facebook_user) {
		            moveToS3Link("facebook/account/", $m['sender']['id'], $facebook_user['account_picture']);
		            $message->account_name = $facebook_user['account_name'];
		            $message->account_picture = Storage::disk('s3')->url("facebook/account/" . $m['sender']['id'] . '.jpg');
	            } else {
		            $message->account_name = 'Facebook User';
		            $message->account_picture = '';
	            }

	            if (isset($m['message']['text'])) {
		            $message->text = $m['message']['text'];
	            }
	            $message->save();
	            if (isset($m['message']['attachments'])) {
		            \Log::info("message");
		            foreach ($m['message']['attachments'] as $a) {

                        

			            //if($a['type'] != 'fallback'){
			            \Log::info("atachment");
                        if(isset($a['payload']['url'])){
    			            moveToS3Link("facebook/files/" . date('Y-m-d') . "/", substr($m['message']['mid'], -23), $a['payload']['url']);


    			            $rf = File::create(
    				            ['file_type' => $a['type'],
    					            'file_url' => Storage::disk('s3')->url("facebook/files/" . date('Y-m-d') . "/" . substr($m['message']['mid'], -23) . '.jpg'),
    				            ]);

    			            $message->files()->attach($rf->id);
			            }else{
                             if (!isset($m['message']['text'])) {
                                if(isset($a['title'])){
                                    $message->text = $a['title'];
                                    $message->save();
                                }
                            }
                            if(isset($a['URL'])){
                                $message->text .= "  " . $a['URL'];  
                                $message->save();
                            }
                        }

		            }
	            }
            }

        }
        return "OK";
    }


}
