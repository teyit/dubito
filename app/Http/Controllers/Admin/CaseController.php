<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Model\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cases;
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

    public function update($id,Request $request){

        $case = Cases::find($id);
        $case->update($request->all());
        return 'true';
    }


    public function destroy($id){
        $case = Cases::find($id);
        $case->delete();
        return 'true';
    }
    
}
