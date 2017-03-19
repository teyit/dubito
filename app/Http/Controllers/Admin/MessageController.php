<?php

namespace App\Http\Controllers\Admin;

use App\Model\Message;
use App\Model\MessageFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    private function getSenders(){
        $messages = Message::selectRaw('messages.*')->orderBy('created_at','DESC')->get();

        $senders = $messages->groupBy('sender_id');

        foreach($senders as $key => $s){
            $s->count = $s->where('is_read',0)->count();
        }
        return $senders;
    }



    public function index(){


        $senders = $this->getSenders();

        $messages = Message::where('sender_id',$senders->first()->first()->sender_id)->get();

        return view('message.index',compact('senders','messages'));
    }




	public function show(Request $request, $id){

        $senders = $this->getSenders();
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
			return view('message.index',compact('senders','messages'));
		}
	}

}
