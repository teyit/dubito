<?php

namespace App\Http\Controllers\Admin;

use App\Model\Message;
use App\Model\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function index(){
        $reviews = Message::where('is_review',true)->latest()->get();
        return view('review.index',compact('reviews'));
    }

}
