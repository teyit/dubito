<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Topic;

class TopicController extends Controller
{

    public function index(){
        $topics = Topic::all();
        return view("topic.index",compact("topics"));
    }

     public function create(){
     $topics = Topic::all();
    return view("topic.create",compact("topics"));
    }

    public function store(Request $request){
        $store = $request->all();
        Topic::create($store);
        return redirect("/topics/");
    }
    

    public function edit($id){
        return Topic::find($id);
    }

    public function update($id,Request $request){
       $topic = Topic::find($id);
       $topic->update($request->all());
       return 'true';
    }


    public function destroy($id){
        $topic = Topic::find($id);
        $topic ->delete();
        return redirect("/topics/");
    }
}

