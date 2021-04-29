<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class IsAdmin
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
        //get the user
        $user = Auth::user();
        //is the user logged in?
        if ($user == null) {
          //user is not logged in
          return redirect('/login');
        } else if ($user->is_admin == 0) {
          return redirect('/home')->with('error',"You don't have admin access.");
        } else {
          //the request is allowed
          return $next($request);
        }


    }
}
