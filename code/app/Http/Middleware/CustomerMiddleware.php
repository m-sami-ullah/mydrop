<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use View;
use Session;
use URL;
class CustomerMiddleware
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
        if (!Auth::guard('customer')->check()) 
        {
            if (!$request->routeIs('customer.auth')) 
            {
                Session::put('url.intended', URL::current());
            }
            return redirect()->route('customer.auth');
        }
            return $next($request);
    }
}
