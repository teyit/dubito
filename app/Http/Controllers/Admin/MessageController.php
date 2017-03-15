<?php

namespace App\Http\Controllers\Admin;

use App\Model\Message;
use App\Model\MessageFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
	public function index(){
		$senders = Message::groupBy('sender_id','recipient_id')->get();
		$messages = Message::where('sender_id','1672136149469483')->get();
		return view('message.index',compact('senders','messages'));
	}

}
