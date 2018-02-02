<?php

namespace App\Http\Controllers\Admin;

use App\Model\CaseLink;
use App\Model\Cases;
use App\Model\Link;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class LinkController extends Controller
{

    
    public function RequestTeyitLink($url){
        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://teyit.link/add?request_url='.$url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));

        curl_exec($ch);
        $redir = curl_getinfo($ch, CURLINFO_REDIRECT_URL);

        curl_close($ch);

        return explode("/",$redir);

    }



    

    public function store(Request $request){

        $teyitLink = $this->RequestTeyitLink($request->get("link"));


        $data = $request->all();

        $data["meta_title"] = explode("/",request("link"))[2];
        $data["teyitlink_slug"] = $teyitLink[3];

        $link = Link::create($data);

        $case_id = $request->input('case_id');


        if(isset($case_id)){
            $case = Cases::find($case_id);

            $case->links()->attach($link->id);
        }
        return redirect('cases/'.$case_id);
    }


    public function edit(Request $request,$id){
        $link = Link::find($id);
        return response()->json($link,200);

    }


    public function update(Request $request, $id){
        $link = Link::find($id);
        $link->update($request->all());
        $case_id = $request->input('case_id');


        if(isset($case_id)){
            $case = Cases::find($case_id);
            $case->links()->detach($link->id);
            $case->links()->attach($link->id);
        }
       return response()->json($link,200);
    }



    public function destroy(Request $request,$id){

        $link = Link::find($id);
        $link->delete();

        $case_id = $request->input('case_id');

        if(isset($case_id)){
            $case = Cases::find($case_id);
            $case->links()->detach($link->id);
        }


        return response()->json(true,200);
    }
}
