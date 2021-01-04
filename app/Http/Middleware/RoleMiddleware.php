<?php
namespace App\Http\Middleware;
use Closure;
use  App\Models\User;
use Illuminate\Contracts\Auth\Factory as Auth;
class RoleMiddleware { 
	/**
    * Handle the incoming request. 
    * 
    * @param \Illuminate\Http\Request $request 
    * @param \Closure $next 
    * @param string $role 
    * @return mixed 
    */ 
    public function handle($request, Closure $next, $role = "")
    {
    	if (Auth::id_tfv042119_role()  1 {
            return $next($request);
        }
        return response('Unauthorized.', 401);
	}
}