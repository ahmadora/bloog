<?php

namespace App\Http\Middleware;

use Closure;

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
//        if (auth()->user()->role->name != 'TENANT_ADMIN') {
//            return redirect('/home')->with(‘error’,"You don't have Tenant access.");
//    }
        return $next($request);
    }
}
