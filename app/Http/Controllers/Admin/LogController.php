<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function index(){
//        $activity = Activity::all()->last();
//        $changes  = $activity->changes->toArray();
//
//        dd(implode(',',$changes['old']));

        /*dd(json_decode($activity->changes));*/
        $activities = Activity::latest()->get();

        return view('log.index',compact('activities'));

    }
}
