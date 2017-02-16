<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{


     public function create(){
     $categories = Category::all();
    return view("category.create",compact("categories"));
    }

    public function store(Request $request){
        $store = $request->all();
        Category::create($store);
        return redirect("/categories/create");
    }
    

    public function edit($id){
        
        $categories = Category::all();
        $category = Category::find($id);
        return view("category.edit",compact('category','categories'));
    }

    public function update($id,Request $request){

       $category = Category::find($id);
       $category->update($request->all());
       return redirect("/categories/create");
    }


    public function destroy($id){

        $category = Category::find($id);
        $category->delete();
        return redirect("/categories/create");
    }
}
