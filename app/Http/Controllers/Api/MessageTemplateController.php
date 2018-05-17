<?php

namespace App\Http\Controllers\Api;

use App\Model\MessageTemplate;
use App\Model\Category;
use App\Model\Message;
use App\Model\Report;
use App\Model\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageTemplateController extends Controller
{
    public function index(){
        $templates  = MessageTemplate::latest()->get();
        $q = request()->get('q');
        if(isset($q)) {

            if(empty($q)){
                return response()->json($caseList,200);
            }

            $templateList = MessageTemplate::where('text', 'LIKE', '%'.$q.'%')->get();


            return response()->json($templateList,200);

      }
      return response()->json($templates,200);

    }

    public function store(Request $request){

        $data = request()->all();
        
        unset($data['user_id']);
        $exist = MessageTemplate::where('text',"=",$data['text'])->get();
        if(count($exist) > 0){
         return response()->json($exist,500);
 
        }
        $template =  MessageTemplate::create($data);


       return response()->json($template,200);
    }
    public function destroy(Request $request){
            $data = request()->all();
            
            unset($data['user_id']);
            $exist = MessageTemplate::where('text',"=",$data['text'])->delete();
           return response()->json($exist,200);
    }
}
