<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{

    public function handle($request, Closure $next, ...$role)
    {

        if(! in_array(Auth::user()->role->name,$role)){
            return redirect('/');
        }


        return $next($request);

    }


}
