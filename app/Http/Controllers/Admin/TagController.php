<?php

namespace App\Http\Controllers\Admin;

use App\Model\Tag;
use App\Model\Topic;
use App\Model\Cases;
use App\Model\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TagController extends Controller
{

    public function __construct()
    {
     //   $this->middleware('role:Admin');
    }
    
    
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
    public function feed($tag='KHK'){
        
/*
        if( !in_array($folder,['cold_cases','news_feed','archive'])){
            return redirect()->route("admin.dashboard");
        }*/

        $topics = Topic::latest()->get();
        $tags = Tag::latest()->get();
        $cases = Cases::whereRaw('id IN (SELECT case_tags.case_id from tags inner join case_tags on tag_id=tags.id where tags.title="'. $tag .'")')->get();
        $categories = Category::latest()->get();
        $statusLabels = [];

        foreach(Cases::first()->statusLabels as $key => $val){
            $statusLabels[] = ['value' => $key,'text' => $val];
        }
        $users = User::select('id as value','name as text')->latest()->get();
        return view("case.index",compact("cases",'topics','categories','statusLabels','users','tags'));
    }
}
