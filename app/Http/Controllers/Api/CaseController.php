<?php

namespace App\Http\Controllers\Api;

use App\Model\Cases;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaseController extends Controller
{
    public function index(){
      return Cases::latest()->get();
    }

    public function store(Request $request){
        Cases::create($request->all());
        return response()->json(true,200);

    }
}
