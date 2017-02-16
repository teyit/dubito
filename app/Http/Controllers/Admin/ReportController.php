<?php

namespace App\Http\Controllers\Admin;

use App\Model\Cases;
use App\Model\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function create(){
      $topics = Topic::latest()->get();
      $cases = Cases::all();
      return view("report.create",compact('topics'));
    }


    public function store(Request $request){
      dd($request->all());
    }
}
