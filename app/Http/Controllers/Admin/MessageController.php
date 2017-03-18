<?php

namespace App\Http\Controllers\Admin;

use App\Model\Message;
use App\Model\MessageFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index(){


        $senders = Message::selectRaw('messages.*,count(id) as count')->groupBy('sender_id','recipient_id')->get();

        $messages = Message::where('sender_id','1672136149469483')->get();

        return view('message.index',compact('senders','messages','count'));
    }




	public function show(Request $request, $id){
		$messages = Message::where('sender_id',$id)->get();

        Message::where('sender_id', $id)->update(['is_read' => 1]);

		if($request->has('spf')){
			return json_encode([
				'title' => 'Mesajlar: ' . $messages->first()->account_name,
				'body' => [
					'section-thread' => view('message.thread',['messages' => $messages])->render()
				]
			]);
		}else{
			$senders = Message::groupBy('sender_id','recipient_id')->get();
			$messages = Message::where('sender_id',$id)->get();
			return view('message.index',compact('senders','messages'));
		}
	}

}
