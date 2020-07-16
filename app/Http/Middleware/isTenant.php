<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class isTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $user = Auth::user()-email;
//        $tenant = DB::table('users')->where('isCustomer','=',null);
//        if () {
//            return redirect('/home')->with(‘error’,"You don't have Tenant access.");
//    }
        return $next($request);
    }
}
