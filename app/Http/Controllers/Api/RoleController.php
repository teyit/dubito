<?php

namespace App\Http\Controllers\Api;


use App\Model\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::latest()->get();


        $rolesArray = [];

        foreach ($roles as $index => $role) {
            $rolesArray[$index]['value'] = $role->id;
            $rolesArray[$index]['text'] = $role->name;
        }


        return response()->json($rolesArray,200);


    }

}
