<?php

namespace App\Http\Controllers\Admin;

use App\Model\CaseLink;
use App\Model\Cases;
use App\Model\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{

    public function store(Request $request){
        $link = Link::create($request->all());

        $case_id = $request->input('case_id');

        if(isset($case_id)){
            $case = Cases::find($case_id);
            $case->links()->attach($link->id);
        }
        return redirect('cases/'.$case_id);
    }


    public function edit(Request $request,$id){
        $link = Link::find($id);
        return response()->json($link,200);

    }


    public function update(Request $request, $id){
        $link = Link::find($id);
        $link->update($request->all());
        $case_id = $request->input('case_id');


        if(isset($case_id)){
            $case = Cases::find($case_id);
            $case->links()->detach($link->id);
            $case->links()->attach($link->id);
        }
       return response()->json($link,200);
    }



    public function destroy(Request $request,$id){

        $link = Link::find($id);
        $link->delete();

        $case_id = $request->input('case_id');

        if(isset($case_id)){
            $case = Cases::find($case_id);
            $case->links()->detach($link->id);
        }


        return response()->json(true,200);
    }
}
