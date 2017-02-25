<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index(){

        $categories = Category::all();
        return view("category.index",compact("categories"));
    }

     public function create(){
     $categories = Category::all();
    return view("category.create",compact("categories"));
    }

    public function store(Request $request){
        $store = $request->all();
        Category::create($store);
        return redirect("/categories");
    }
    

    public function edit($id){

        return Category::find($id);
        //return view("category.edit",compact('category','categories'));
    }

    public function update($id,Request $request){
       $category = Category::find($id);
       $category->update($request->all());
       return 'true';
    }


    public function destroy($id){

        $category = Category::find($id);

        if($category->cases->count() > 0 ){
            return  'is_case';
        }

        $category->delete();
        return 'true';
    }
}
