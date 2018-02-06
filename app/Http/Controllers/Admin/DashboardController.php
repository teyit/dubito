<?php

namespace App\Http\Controllers\Admin;

use App\Model\Message;
use App\Model\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin,Writer');
    }

    public function index(){

        $reportCountbySource = Message::select('source')
            ->selectRaw('count(*) as total')
            ->where('report_id','!=',0)
            ->groupBy('source')->get()
            ->toArray();




        $fileTypeCount = DB::table('reports')
            ->select('file_type')
            ->selectRaw('count(*) as total')
            ->join("report_files",'report_files.report_id','=','reports.id')
            ->join('files','files.id','=','report_files.file_id')
            ->groupBy('file_type')
            ->get()->toArray();




        $reportTopicCount = DB::table('reports')
            ->select('topics.title')
            ->selectRaw('count(reports.id) as total')
            ->join("cases",'reports.case_id','=','cases.id')
            ->join('topics','topics.id','=','cases.topic_id')
            ->groupBy('topic_id')
            ->get()->toArray();

//        dd($reportTopicCount);



        return view('dashboard.index',compact("reportCountbySource","reportTopicCount"));
    }
}
