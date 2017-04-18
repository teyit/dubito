<?php

namespace App\Http\Controllers\Admin;

use App\Libraries\Google\GoogleDocument;
use App\Model\CaseLink;
use App\Model\Category;
use App\Model\Evidence;
use App\Model\Tag;
use App\Model\Topic;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cases;
use Illuminate\Support\Facades\Auth;

class CaseController extends Controller
{

    protected $redirect = 'cases';



    public function index($is_archived){
        $topics = Topic::latest()->get();
        $cases = Cases::where('is_archived',$is_archived)->get();
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

        $case = Cases::create($store);
        $case->setGoogleDocument();
        $case->save();

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

        $case = Cases::with('reports','evidences')->find($id);

        $links = $case->links()->get();
        $selectedTags= array_pluck($case->tags()->get()->toArray(),'id');
        $allTags  = Tag::latest()->get();
        $users = User::latest()->get();
        return view('case.show',compact('users','case','selectedTags','allTags','links','evidences'));
    }

    public function update($id,Request $request){

        $case = Cases::find($id);
        $case->update($request->all());
        return response()->json('true',200);
    }




    public function destroy($id){
        $case = Cases::find($id);
        $case->delete();
        return response()->json(true,200);


    }


    public function addCaseTag(Request $request,$caseID){

        $case = Cases::find($caseID);
        $tags = $request->input('tags');
        if(!is_array($tags)){
            $tags = [];
        }

        $case->tags()->sync($tags);
        return response()->json(true,200);

    }

    public function addCaseFile(Request $request,$caseID){
        $case = Cases::find($caseID);
        $file = $request->input('file_id');

        if(!$case->files->contains($file)){
           $case->files()->attach($file);
            return response()->json(true,200);
        }
        return response()->json(false,200);

    }


    public function removeCaseFile(Request $request,$caseID){
        $case = Cases::find($caseID);
        $file = $request->input('file_id');
        $case->files()->detach($file);
        return response()->json(true,200);

    }


    public function caseStatusUpdate(Request $request,$caseID){
        $case = Cases::find($caseID);
        $status = $request->input('status');

        $case->status = $status;
        $case->save();

        return response()->json(true,200);

    }
    
    public function assignUserToCase(Request $request,$caseID){

        $case = Cases::find($caseID);
        $case->user_id = $request->input('pk');
        $case->save();
        return response()->json(true,200);

    }


    public function caseSendToArchive(Request $request,$caseID){
        $case = Cases::find($caseID);
        $case->is_archived = $request->input('is_archived');
        $case->save();
        return response()->json(true,200);
    }


}
