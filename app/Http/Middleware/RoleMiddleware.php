<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    public function handle($request, Closure $next, $role, $abitlity = null)
    {
        if(!$request->user()->hasRole($role)) {
            abort(404);
        }

        if($abitlity !== null && !$request->user()->can($abitlity)) {
            abort(404);
        }
        return $next($request);
    }
}
