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
    private function getSenders(){
        $messages = Message::selectRaw('messages.*')->orderBy('created_at','ASC')->get();

        $senders = $messages->groupBy('sender_id');

        foreach($senders as $key => $s){
            $s->count = $s->where('is_read',0)->count();
        }
        return $senders;
    }



    public function index(){


        $senders = $this->getSenders();

        $messages = Message::where('sender_id',$senders->first()->first()->sender_id)->paginate(5);

        $topics = Topic::latest()->get();

        $categories = Category::latest()->get();



        return view('message.index',compact('senders','messages','topics','categories'));
    }




	public function show(Request $request, $id){

        $senders = $this->getSenders();

        $messages = Message::where('sender_id',$id)->orderBy('created_at','ASC')->paginate(5);

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

}
