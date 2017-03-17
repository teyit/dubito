<?php

namespace App\Http\Controllers\Admin;

use App\Model\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::latest()->get();
        return view('tag.index',compact('tags'));
    }
    public function create(){
        $type = 'create';
        $tags = Tag::latest()->get();
        return view("tag.create",compact("tags",$type));
    }
    
    public function store(Request $request){
         Tag::create($request->all());
         return redirect("/tags");
    }

    public function edit($id,Request $request){
        return Tag::find($id);
    }
    
    public function update($id, Request $request){
       $tag = Tag::find($id);
       $tag->update($request->all());
        return response()->json('true',200);

    }

    public function destroy($id){
        $tag = Tag::find($id);
        $tag->delete();
        return response()->json('true',200);

    }
}
