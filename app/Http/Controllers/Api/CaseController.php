<?php

namespace App\Http\Controllers\Api;

use App\Model\Cases;
use App\Model\Message;
use App\Model\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaseController extends Controller
{
    public function index(){
      return Cases::latest()->get();
    }

    public function store(Request $request){
       $case =  Cases::create($request->all());

        if(!empty(request()->get('selected_messages'))){
            $messages = Message::whereIn('id',$request->get('selected_messages'))->get();
            $text = $messages->implode('text',"\n");

            $report = Report::create([
                'text' => $text,
                'case_id' => $case->id,
                'source' => $messages->first()->source
            ]);

            $filePrefix = date("Y/m/d") . '/'."report-".$report->id;

            foreach($messages as $m){

                $m->update([
                    'report_id' => $report->id
                ]);
                if(!$m->files->isEmpty()){

                    foreach($m->files as $index => $file){
                        $report->files()->attach($file->id);

                    }
                }
                if(!$m->links->isEmpty()){
                    foreach($m->links as $index => $link){
                        $report->links()->attach($link->id);

                    }
                }
            }
        }


        return response()->json(true,200);

    }
}
