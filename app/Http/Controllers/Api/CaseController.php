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
                $caseList = $cases->map(function($case){
                    return ['id' => $case->id, 'text' => $case->title];
                });
                return response()->json($caseList,200);
            }

            $caseList = Cases::where('title', 'LIKE', '%'.$q.'%')->get()->map(function($case){
                return ['id' => $case->id, 'text' => $case->title];
            });


            return response()->json($caseList,200);

      }
      return response()->json($cases,200);

    }

    public function store(Request $request){
        $tags = request()->input('tags',[]);


        $category_id = request()->input('category_id');

        if(strlen($category_id) > 1){
            $category = Category::firstOrCreate(['title' =>$category_id ]);
            $data = array_merge(request()->all(),['category_id' => $category->id]);
        }else{
            $data = array_merge(request()->all(),['category_id' => $category_id]);
        }
        unset($data['user_id']);
        
       $case =  Cases::create($data);


        if(!is_array($tags)){
            $tags = [];
        }


        $case->tags()->sync($tags);


       return response()->json($case,200);

    }
}
