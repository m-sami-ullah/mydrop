<?php
namespace App\Http\Middleware;
use App\Models\Siteconfig;
use Closure;
use View;
class ShareMiddleware
{

    public function handle($request, Closure $next, $guard = null)
    {
        
        $siteconfig =  Siteconfig::first();
        View::share('siteconfig', $siteconfig);
        return $next($request);
        
    }
}