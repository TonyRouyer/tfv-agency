<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Models\User;

class RoleMiddlewareDeux { 
	/**
    * Handle the incoming request. 
    * 
    * @param \Illuminate\Http\Request $request 
    * @param \Closure $next 
    * @param string $role 
    * @return mixed 
    */ 
    
    public function handle($request, Closure $next){
        if ( auth()->user() != null ){
            $role = auth()->user()->id_tfv042119_role ;
            if ($role == '1' || $role == '2') {
                return $next($request);
            }else {
                return response('Unauthorized.', 401);
            }
        }
        else{
            return response('Unauthorized.', 401);
        }
        
	}
}