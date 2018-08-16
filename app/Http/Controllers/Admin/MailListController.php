<?php

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use App\Model\Tag;
use App\User;
use App\Model\LinkMailList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailListController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:Admin');
    }


    public function index(){
        $users = LinkMailList::latest()->get();
        return view('mailList.index',compact('users'));
    }


    public function store(){
        $request = request()->all();

        LinkMailList::create($request);

        return response()->json(true,200);

    }

    public function edit($id){
        $user = LinkMailList::find($id);

        return response()->json(["mailList" => $user],200);


    }



    public function update($id){
        $user = LinkMailList::find($id);
        $request = request()->all();

        $user->update($request);
        return response()->json(true,200);

    }

    public function destroy($id){
        $user = LinkMailList::find($id);

        $user->delete();

        return response()->json(true,200);

    }

}
