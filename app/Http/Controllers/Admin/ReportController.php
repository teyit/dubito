<?php

namespace App\Http\Controllers\Admin;

use App\Model\Cases;
use App\Model\Category;
use App\Model\Report;
use App\Model\Topic;

use App\Model\ReportFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;

class ReportController extends Controller
{


    public function index(){

        dd("index");
    }


    public function create(){
      $topics = Topic::latest()->get();
      $cases = Cases::latest()->get();
      $categories = Category::latest()->get();
      return view("report.create",compact('topics','cases','categories'));
    }


    public function store(Request $request){

        $report = Report::create([
           'title' => $request->input('title'),
            'case_id' => $request->input('case_id'),
            'source' => $request->input('source')
        ]);

        $files = $request->file("report_files");
        $filePrefix = date("Y/m/d") . '/'."report-".$report->id;

        $results = [];
        foreach ($files as $index => $file) {
            $results[$index]['file_url'] = $file->storeAs(
            $filePrefix, $file->getClientOriginalName(),'s3'
          );
            $results[$index]['file_type'] = $file->getMimeType();
        }


        foreach ($results as $index => $result) {
            ReportFile::create([
                    'report_id' => $report->id,
                    'category_id' => $request->input('category_id'),
                    'file_url' => $result['file_url'],
                    'file_type' => $result['file_type']
            ]);
        }

        return redirect("/reports");

    }

    public function edit($id){
        $topics = Topic::latest()->get();
        $cases = Cases::latest()->get();
        $categories = Category::latest()->get();
        $report = Report::with('reportfiles')->find($id);

        $is_edit = true;
        return view("report.edit",compact('report','topics','cases','categories','is_edit'));
    }
}
