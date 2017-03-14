<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Model\Tag;
use App\Model\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cases;
use Illuminate\Support\Facades\Auth;

class CaseController extends Controller
{

    protected $redirect = 'cases';



    public function index(){
        $topics = Topic::latest()->get();
        $cases = Cases::latest()->get();
        $categories = Category::latest()->get();
        return view("case.index",compact("cases",'topics','categories'));
    }
    public function create(){
        $topics = Topic::latest()->get();
        $cases = Cases::latest()->get();
        return view("case.create",compact("cases",'topics'));
    }

    public function store(Request $request){
        $request['user_id'] = Auth::user()->id;
        $store = $request->all();
        Cases::create($store);
        return redirect($this->redirect);
    }


    public function edit($id){

        $case = Cases::find($id);
        $categories = Category::latest()->get();
        $topics = Topic::latest()->get();

        return [
            'case' => $case,
            'categories' => $categories,
            'topics' => $topics
        ];
    }

    public function show($id){
        $case = Cases::find($id);
        $selectedTags= array_pluck($case->tags()->get()->toArray(),'id');
        $allTags  = Tag::latest()->get();

        return view('case.show',compact('case','selectedTags','allTags'));
    }

    public function update($id,Request $request){

        $case = Cases::find($id);
        $case->update($request->all());
        return 'true';
    }



    public function addCaseTag(Request $request,$caseID){

        $case = Cases::find($caseID);
        $tags = $request->get('tags');

        $case->tags()->sync($tags);
        return response()->json('true',200);
    }

    public function destroy($id){
        $case = Cases::find($id);
        $case->delete();
        return 'true';
    }
    
}
