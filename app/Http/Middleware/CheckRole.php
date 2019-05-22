<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
	 * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
		if (!$request->user()->hasRole($role)) {
			throw new AuthorizationException('You do not have permission to view this page');
		}
        return $next($request);
    }
}
