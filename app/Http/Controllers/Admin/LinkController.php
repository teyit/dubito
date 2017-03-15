<?php

namespace App\Http\Controllers\Admin;

use App\Model\CaseLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{



    public function store(Request $request,$case_id){
        $store = $request->all();
        CaseLink::create($store);
        return redirect('cases/'.$case_id);
    }


    public function edit(Request $request,$case_id,$link_id){
        return CaseLink::find($link_id);
    }


    public function update(Request $request, $case_id,$link_id){
        $update = $request->all();

       $case =  CaseLink::find($link_id);

       $case->update($update);

       return response()->json($case,200);
    }



    public function destroy(Request $request, $case_id,$link_id){

        $case = CaseLink::find($link_id);

        $case->delete();

        return response()->json("true",200);
    }
}
