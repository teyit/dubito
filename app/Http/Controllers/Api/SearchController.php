<?php

namespace App\Http\Controllers\Api;

use App\Model\Cases;
use App\Model\Category;
use App\Model\Message;
use App\Model\Report;
use App\Model\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(){

        $results = [];
        if(request()->has('term')){

            $term = request()->get('term');

           $cases = Cases::where('title', 'LIKE', '%'.$term.'%')->get()->toArray();

            if(! empty($cases)){
                foreach($cases as $case){
                    $result["id"] = $case['id'];
                    $result["text"] = $case['title'];
                    $result["category"] = "Case";
                    $result["url"] = "/cases/".$case["id"];
                    $result["folder"] = $case["folder"];
                    $results[] = $result;
                }
                return $results;
            }

        }

        return [];

    }
}
