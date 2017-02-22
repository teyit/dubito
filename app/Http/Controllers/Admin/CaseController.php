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
        $categories = Category::latest()->get();
        $topics = Topic::latest()->get();
        $cases = Cases::latest()->get();
        $case = Cases::find($id);
        return view("case.edit",compact('cases','case','topics','categories'));
    }

    public function update($id,Request $request){

        $case = Cases::find($id);
        $case->update($request->all());
        return redirect($this->redirect);
    }


    public function destroy($id){
        $case = Cases::find($id);
        $case->delete();
        return redirect($this->redirect);
    }
    
}
