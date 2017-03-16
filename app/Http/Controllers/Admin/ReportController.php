<?php

namespace App\Http\Controllers\Admin;

use App\Model\Cases;
use App\Model\Category;
use App\Model\Message;
use App\Model\Report;
use App\Model\Topic;

use App\Model\ReportFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ReportController extends Controller
{


    public function index(){

        $reports = Report::with('images')->latest()->get();

        return view('report.index',[
            'reports' => $reports
        ]);
    }


    public function create(){
      $topics = Topic::latest()->get();
      $cases = Cases::latest()->get();
      $categories = Category::latest()->get();
      return view("report.create",compact('topics','cases','categories'));
    }


    public function store(Request $request){

        if(!$request->has('selected_messages')){
            return "empty";
        }


        $messages = Message::whereIn('id',$request->get('selected_messages'))->get();


        $text = $messages->implode('text',"\n");


        $report = Report::create([
           'text' => $text,
            'case_id' => $request->input('case_id'),
            'source' => $messages->first()->source
        ]);



        $filePrefix = date("Y/m/d") . '/'."report-".$report->id;

        foreach($messages as $m){
            $m->update([
                'report_id' => $report->id
            ]);
            if(!$m->files->isEmpty()){

                foreach($m->files as $index => $file){
                    $file_url  = $file->storeAs($filePrefix, $file->getClientOriginalName(),'s3');


                    ReportFile::create([
                        'report_id' => $report->id,
                        'file_url' => $file_url,
                        'file_type' => $file->getMimeType()
                    ]);

                }
            }
        }

        return "OK";

    }

    public function edit($id){
        $topics = Topic::latest()->get();
        $cases = Cases::latest()->get();
        $categories = Category::latest()->get();
        $report = Report::with('reportfiles')->find($id);

        $is_edit = true;
        return view("report.edit",compact('report','topics','cases','categories','is_edit'));
    }

    public function show($id){
        $report = Report::with('reportfiles')->find($id);
        return view('report.show',compact('report'));
    }

    public function update($id,Request $request){

        $report = Report::find($id);

        $report->update($request->all());

        return 'true';

    }


    public function destroy($id){
        $report = Report::find($id);

        $report->delete();

        return redirect('/reports');

    }

    //report file status
    public function status($id,Request $request){

       $file  =  ReportFile::find($id);
       $file->status = $file->status == 1 ? 0 : 1;
       $file->save();
        return redirect('reports/'.$file->report_id);
    }





}
