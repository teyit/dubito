<?php

namespace App\Http\Controllers;

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
        return $request->get('hub_challenge');
    }
    public function twitter()
    {
        return "OK";   
    }
}
