<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Models\User;

class RoleMiddleware { 
	/**
    * Handle the incoming request. 
    * 
    * @param \Illuminate\Http\Request $request 
    * @param \Closure $next 
    * @param string $role 
    * @return mixed 
    */ 
    
    public function handle($request, Closure $next)
    {
        $role = auth()->user()->id_tfv042119_role ;

    	if ($role == '1') {
            return $next($request);
        }else if ($role == '2') {
            return $next($request);
        }else if ($role == '4'){
            return $next($request);
        }


            return response('Unauthorized.', 401);
        
        
	}
}