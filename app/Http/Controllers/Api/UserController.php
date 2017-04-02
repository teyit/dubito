<?php

namespace App\Http\Controllers\Api;


use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
         $users = User::latest()->get();
         $usersArray = [];

        foreach ($users as $index => $user) {
            $usersArray[$index]['value'] = $user->id;
            $usersArray[$index]['text'] = $user->name;
         }



         return response()->json($usersArray,200);

    }

}
