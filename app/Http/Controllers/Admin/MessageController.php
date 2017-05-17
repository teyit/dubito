<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Model\Message;
use App\Model\MessageFile;
use App\Model\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
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
            $senders->where(function($q){
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
