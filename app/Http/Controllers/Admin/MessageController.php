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
        $page = $request->get('page',1);

        $senders = $this->getSenders($page);

        return view('message.partials.senders',["senders" => $senders]);

    }
    private function getSenders($page){

        $senders = \DB::table('messages')->orderBy('created_at','DESC')->selectRaw('sender_id,account_name,account_picture,count(CASE is_read WHEN 1 THEN 1 ELSE 0 END) as unreads')->groupBy('sender_id')->get()->toArray();
        $length = 40;
        
        $data = array_slice($senders,($page-1) * $length,$length);

        return $data;

    }



    public function index(Request $request){

        $page = $request->get('page',1);

        $senders = $this->getSenders($page);

        $messages = Message::where('sender_id',$senders[0]->sender_id)->orderBy('id','DESC')->paginate(30);

        $topics = Topic::latest()->get();

        $categories = Category::latest()->get();



        return view('message.index',compact('senders','messages','topics','categories'));
    }




	public function show(Request $request, $id){

        $page = $request->get('page',1);

        $senders = $this->getSenders($page);

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
