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
		return view('messages.index',compact('senders'));
	}

}
