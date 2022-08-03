<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSupervisor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (isset(auth()->user()->user_role)){
            if(auth()->user()->user_role == 2){
                return $next($request);
            }
        }
   
        return redirect('/')->with('error', "You don't have Supervisor access.");
    }
}
