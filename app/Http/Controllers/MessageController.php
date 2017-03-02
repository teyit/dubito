<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class MessageController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function facebook(Request $request)
    {
        foreach($request->get('entry') as $e){
	        $e['id'];
        }
        return "OK";
    }
    public function twitter()
    {
        return "OK";   
    }
}
