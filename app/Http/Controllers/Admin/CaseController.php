<?php

namespace App\Http\Controllers\Admin;

use App\Model\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cases;
class CaseController extends Controller
{

    public function create(){
        $topics = Topic::all();
        $cases = Cases::all();
        return view("case.create",compact("cases",'topics'));
    }

    public function store(Request $request){
        $store = $request->all();
        Cases::create($store);
        return redirect("/cases/create");
    }


    public function edit($id){
        $topics = Topic::all();
        $cases = Cases::all();
        $case = Cases::find($id);
        return view("case.edit",compact('cases','case','topics'));
    }

    public function update($id,Request $request){

        $case = Cases::find($id);
        $case->update($request->all());
        return redirect("/cases/create");
    }


    public function destroy($id){
        $case = Cases::find($id);
        $case->delete();
        return redirect("/cases/create");
    }
    
}
