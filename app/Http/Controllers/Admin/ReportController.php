<?php

namespace App\Http\Controllers\Admin;

use App\Model\Cases;
use App\Model\Category;
use App\Model\File;
use App\Model\Message;
use App\Model\Report;
use App\Model\Topic;

use App\Model\ReportFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ReportController extends Controller
{


    public function index($folder="ongoing"){

        $reports = Report::with('images')->where('folder',$folder)->orderBy("created_at","DESC")->get();
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

        $messages = Message::whereIn('id',$request->get('selected_messages'))->orderBy('is_reply','ASC')->get(); //Not pick a reply.

        $first = $messages->first();

        $text = $messages->implode('text',' <br /><br />');


        $report = Report::create([
            'text' => $text,
            'case_id' => $request->get('case_id'),
            'source' => $first->source,
            'account_name' => $first->account_name,
            'account_picture' => $first->account_picture,
            'folder' => request()->has('folder') ? request()->input('folder') : 'ongoing'
        ]);

        foreach($messages as $m){

            $m->update([
                'report_id' => $report->id,
                'case_id' => $request->get('case_id')
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

        return response()->json(true,200);

    }
    
    
    public function customStore(Request $request){

        $report = Report::create([
            'text' => $request->input('text'),
            'case_id' => $request->input('case_id'),
            'source' => $request->input('source'),
            'account_name' => $request->input('account_name'),
            'status' => $request->input('status'),
            'phone' => $request->input('phone')
        ]);


        $filePrefix = date("Y/m/d") . '/'."report-".$report->id;
        if($request->hasFile('report_files')){
            $files = $request->file('report_files');

            foreach ($files as $index => $file) {

                $file =  File::create([
                    'file_url' =>$file->storeAs($filePrefix,$file->getClientOriginalName(),'s3'),
                    'file_type' => explode('/',$file->getMimeType())[0]
                ]);

                if(!$report->files->contains($file->id)){
                    $report->files()->attach($file->id);
                }
            }
        }


        return redirect("/report/ongoing");
    }




    public function edit($id){
        $topics = Topic::latest()->get();
        $cases = Cases::latest()->get();
        $categories = Category::latest()->get();
        $report = Report::find($id);

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

        return response()->json('true',200);

    }


    public function customUpdate(Request $request,$id){

        $report = Report::find($id);

        $report->update($request->all());

        $filePrefix = date("Y/m/d") . '/'."report-".$report->id;
        if($request->hasFile('report_files')){
            $files = $request->file('report_files');

            foreach ($files as $index => $file) {

                $file =  File::create([
                    'file_url' =>$file->storeAs($filePrefix,$file->getClientOriginalName(),'s3'),
                    'file_type' => explode('/',$file->getMimeType())[0]
                ]);

                if(!$report->files->contains($file->id)){
                    $report->files()->attach($file->id);
                }
            }
        }


        return redirect("/reports");
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



    public function removeReportFile(Request $request,$reportID){
        $case = Report::find($reportID);
        $file = $request->input('file_id');
        $case->files()->detach($file);
        return response()->json(true,200);

    }



}
