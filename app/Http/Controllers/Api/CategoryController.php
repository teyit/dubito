<?php

namespace App\Http\Controllers\Api;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        return Category::latest()->get();
    }

    public function store(Request $request){

         Category::create($request->all());
         return response()->json('true',200);
    }
}
