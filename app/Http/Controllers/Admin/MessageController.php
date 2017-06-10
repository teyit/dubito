<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Model\Message;
use App\Model\MessageFile;
use App\Model\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Facebook;

class MessageController extends Controller
{

    private function sendFacebook($recipient_id,$text,$attachments = []){
        
        $fb = new Facebook\Facebook([
            'app_id' => '213471075795721',
            'app_secret' => 'e9040fd795bf94e0053fc2de26f7fdba',
            'default_graph_version' => 'v2.6',
        ]);
        $page_access_token = 'EAADCJpukgwkBAE6nD3fdZBGnqwzqB1L4FMYmHeNmiZAKC9mAzGELxdfDzOZAqaL2GuwZA7W86CT6gPA6ls59iy9YMs4ZBMLHKDPefyh4bV25HP4uXdwrbRTItryqU8iE63ybiDZAImYjwMfjFoFYvOM4GrZAtsHfzNlCZA3En7bixAZDZD';

        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->post('/me/messages', [
                'recipient' => [
                    'id' => $recipient_id
                ],
                'message' => [
                    'text' => $text
                ]
            ],$page_access_token);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        $result = $response->getDecodedBody();
        if($result['message_id']){
            return $result['message_id'];
        }

        return false;
        
    
    }
    public function postNew(Request $request){
        
        $message_id = $request->get('message_id');
        $text = $request->get('text');
        $message = Message::find($message_id);
        if(!$message){
            return response()->json([
                'status' => false
            ]);
        }

        $recipient_id = $message->sender_id;

        $message_id = false;

        if($message->source == 'facebook:message'){
            $message_id =  $this->sendFacebook($recipient_id,$text);
        }


        if($message_id){
            $m = new Message();
            $m->source = 'facebook:message';
            $m->sender_id = '207787009653168';
            $m->recipient_id = $recipient_id;
            $m->external_message_id = $message_id;
            $m->account_name = $request->user()->name;
            $m->account_picture = $request->account_picture;
            $m->text = $text;
            $m->save();
            return response()->json([
                'status' => true
            ]);
        }


    }
    public function showSenders(Request $request){
        $senders = $this->getSenders($request->only('source','page','keyword','size'));
        return view('message.partials.senders',["senders" => $senders]);

    }
    private function getSenders($params){
        $keyword = false;
        $source = false;
        $page = 1;
        $size = 40;



        if(isset($params['keyword'])){
            if(strlen($params['keyword']) > 3){
                $keyword = $params['keyword'];
            }
        }
        if(isset($params['source'])){
            $source = $params['source'];
        }
        if(isset($params['page'])){
            $page = intval($params['page']);
        }
        if(isset($params['size'])){
            $size = intval($params['size']);
        }


        $senders = \DB::table('messages')->orderBy('created_at','DESC')->selectRaw('sender_id,account_name,account_picture,count(CASE is_read WHEN 1 THEN 1 ELSE 0 END) as unreads');

        if($keyword){
            $senders->where(function($q) use($keyword){
                return $q->where('account_name','LIKE', '%'. $keyword . '%' )->orWhere('text','LIKE', '%'. $keyword . '%' );
            });
        }

        if($source){
            $senders->where('source', $source);
        }


        $senders = $senders->groupBy('sender_id')->get()->toArray();

        $data = array_slice($senders,($page-1) * $size,$size);

        return $data;

    }



    public function index(Request $request){


        $senders = $this->getSenders($request->only('source','page','keyword','size'));

        $messages = Message::where('sender_id',$senders[0]->sender_id)->orderBy('id','DESC')->paginate(30);

        $topics = Topic::latest()->get();

        $categories = Category::latest()->get();



        return view('message.index',compact('senders','messages','topics','categories'));
    }




	public function show(Request $request, $id){


        $senders = $this->getSenders($request->only('source','page','keyword','size'));

        $messages = Message::where('sender_id',$id)->orderBy('created_at','DESC')->paginate(30);

        $topics = Topic::latest()->get();

        $categories = Category::latest()->get();

        Message::where('sender_id', $id)->update(['is_read' => 1]);


        $currentPage = $request->get('page',false);

        if($currentPage){
            $pageTitle = 'Mesajlar: ' . $messages->first()->account_name.'('.$currentPage.')';
        }else{
            $pageTitle = 'Mesajlar: ' . $messages->first()->account_name;
        }


        if($request->has('spf')){
			return json_encode([
				'title' => $pageTitle,
				'body' => [
					'section-thread' => view('message.thread',['messages' => $messages])->render()
				]
			]);
		}else{
			return view('message.index',compact('senders','messages','topics','categories'));
		}
	}
	
	public function review(){
	    $messageIDS = request()->input('message_ids');
        foreach ($messageIDS as $index => $messageID) {
            $message = Message::find($messageID);
            $message->is_review = true;
            $message->save();
        }

        return response()->json(true, 200);
    }

}
