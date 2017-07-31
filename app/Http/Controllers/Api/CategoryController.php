<?php

namespace App\Http\Controllers\Api;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();

        if(request()->has('editable')){
            $cats = [];

            foreach ($categories as $index => $c) {
                $cats[$index]['value'] = $c->id;
                $cats[$index]['text'] = $c->title;
            }
            return response()->json($cats,200);

        }


        return response()->json($categories,200);

    }

    public function store(Request $request){

         Category::create($request->all());
         return response()->json('true',200);
    }
}
