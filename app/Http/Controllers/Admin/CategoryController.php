<?php

namespace App\Http\Controllers\Admin;
use App\Model\Tag;
use App\Model\Topic;
use App\Model\Cases;
use App\User;
use App\Http\Middleware\CheckRole;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
       // $this->middleware('role:Admin');
    }

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
        return response()->json('true',200);

    }


    public function destroy($id){

        $category = Category::find($id);

        if($category->cases->count() > 0 ){
            return  'is_case';
        }

        $category->delete();
        return response()->json('true',200);

    }

    public function feed($category='KHK'){
        
        /*
                if( !in_array($folder,['cold_cases','news_feed','archive'])){
                    return redirect()->route("admin.dashboard");
                }*/
        
                $topics = Topic::latest()->get();
                $tags = Tag::latest()->get();
                $cases = Cases::whereRaw('category_id IN (SELECT id from categories where title="'. $category .'")')->get();
                $categories = Category::latest()->get();
                $statusLabels = [];
        
                foreach(Cases::first()->statusLabels as $key => $val){
                    $statusLabels[] = ['value' => $key,'text' => $val];
                }
                $users = User::select('id as value','name as text')->latest()->get();
                return view("case.index",compact("cases",'topics','categories','statusLabels','users','tags'));
            }
}
