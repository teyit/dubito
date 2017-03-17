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
        return response()->json('true',200);

    }


    public function destroy($id){
        $topic = Topic::find($id);
        if($topic->cases->count() > 0){
            return response()->json('is_case',200);

        }

        $topic ->delete();
        return response()->json('true',200);

    }
}

