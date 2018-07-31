<?php

namespace App\Http\Controllers\Api;

use App\Model\Cases;
use App\Model\Category;
use App\Model\Message;
use App\Model\Report;
use App\Model\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaseController extends Controller
{
    public function index(){
        $cases  = Cases::latest()->get();
        $q = request()->get('q');
        if(isset($q)) {

            if(empty($q)){
                return response()->json($caseList,200);
            }

            $caseList = Cases::where('title', 'LIKE', '%'.$q.'%')->get();


            return response()->json($caseList,200);

      }
      return response()->json($cases,200);

    }

    public function store(Request $request){
        $tags = request()->input('tags',[]);

        $category_id = request()->input('category_id');
        $category = Category::find($category_id);

        $data = request()->all();
        if($category){
            $data['category_id'] = $category->id;
        }
        
        unset($data['user_id']);
        
        $case =  Cases::create($data);

        $id = ($case->id) % 3;
        if($id == 0){
            $case->user_id = 31;
        }else  if($id == 1){
            $case->user_id = 29;
        }else  if($id == 2){
            $case->user_id = 40;
        }
       
        $case->save();

        if(!is_array($tags)){
            $tags = [];
        }

        $case->tags()->sync($tags);


       return response()->json($case,200);

    }
}
