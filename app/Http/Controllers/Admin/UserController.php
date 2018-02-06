<?php

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use App\Model\Tag;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:Admin');
    }


    public function index(){
        $users = User::latest()->get();
        return view('user.index',compact('users'));
    }


    public function store(){
        $request = request()->all();

        if(request()->has("password")){
            $request = array_merge($request,['password' => bcrypt(request()->get('password'))]);
        }


        User::create($request);

        return response()->json(true,200);

    }


    public function update($id){
        $user = User::find($id);
        $request = request()->all();

        unset($request['password']);

        if(request()->has("password")){
            $request = array_merge($request,['password' => bcrypt(request()->get('password'))]);
        }

        $user->update($request);
        return response()->json(true,200);

    }


    public function edit($id){
        $user = User::with("role")->find($id);

        $roles = Role::all();

        return response()->json(["user" => $user,"roles" => $roles],200);


    }


    public function destroy($id){
        $user = User::find($id);

        $user->delete();

        return response()->json(true,200);

    }


    public function assignRoleToUser(Request $request,$userID=false){

        if($userID == false){
            if($request->get('pk',false)){
                $userID = $request->get('pk');
            }
        }

        $user = User::find(request()->get("pk"));
        $user->role_id = $request->input('value');
        $user->save();
        return response()->json($user->user,200);

    }

}
