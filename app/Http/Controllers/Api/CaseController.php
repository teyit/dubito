<?php

namespace App\Http\Controllers\Api;

use App\Model\Cases;
use App\Model\Category;
use App\Model\Message;
use App\Model\Report;
use App\Model\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaseController extends Controller
{
    public function index(){
      return Cases::latest()->get();
    }

    public function store(Request $request){
        $topic_id = request()->input('topic_id');
        $category_id = request()->input('category_id');

        if(strlen($topic_id ) > 1 and strlen($category_id) > 1){
            $topic = Topic::firstOrCreate(['title' => $topic_id]);
            $category = Category::firstOrCreate(['title' =>$category_id ]);
            $data = array_merge(request()->all(),['topic_id' => $topic->id,'category_id' => $category->id]);
        }else{
            $data = array_merge(request()->all(),['topic_id' => $topic_id,'category_id' => $category_id]);
        }

       $case =  Cases::create($data);

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
