<?php

namespace App\Http\Controllers\Admin;

use App\Model\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function create(){
        $type = 'create';
        $tags = Tag::latest()->get();
        return view("tag.create",compact("tags",$type));
    }
    
    public function store(Request $request){
         Tag::create($request->all());
         return redirect("/tags/create");
    }

    public function edit($id,Request $request){
        $type  = 'edit';
        $tag = Tag::find($id);
        $tags = Tag::latest()->get();
        return view("tag.edit",compact('tag','tags','type'));
    }
    
    public function update($id, Request $request){
       $tag = Tag::find($id);
       $tag->update($request->all());
       return redirect("/tags/create");
    }

    public function destroy($id){
        $tag = Tag::find($id);
        $tag->delete();
        return redirect("/tags/create");
    }
}
