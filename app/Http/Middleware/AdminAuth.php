<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Auth;

class AdminAuth
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
        if(Auth::guard('admin')->user() && Auth::guard('admin')->user()->status == 'active'){
            return $next($request);
        }
        
        return Redirect::to('dashboard/login');
    }
}
