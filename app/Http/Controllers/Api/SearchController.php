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

//           $cases = Cases::where('title', 'LIKE', '%'.$term.'%')->get()->toArray();

            $cases = Cases::join('case_tags', 'case_tags.case_id','=','cases.id')
            ->select("cases.title as case_title", "cases.id as case_id")
            ->join('tags','tags.id','=','case_tags.tag_id')
            ->where('cases.title', 'LIKE', '%' . $term . '%')
            ->orWhere('tags.title','LIKE', '%' . $term . '%')
            ->orderBy('cases.created_at', 'desc')
            ->groupBy('cases.id')
            ->with('tags')
            ->get()->toArray();

            if(! empty($cases)){
                foreach($cases as $case){
                    $result["id"] = $case['case_id'];
                    $result["text"] = $case['case_title'];
                    $result["category"] = "Case";
                    $result["url"] = "/cases/".$case["case_id"];
                    $results[] = $result;
                }
                return $results;
            }

        }

        return [];

    }
}
