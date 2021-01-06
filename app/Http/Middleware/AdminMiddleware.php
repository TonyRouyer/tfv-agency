<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Models\User;

class AdminMiddleware {

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
    $roleUsers = auth()->user()->id_tfv042119_role ;
    if ($roleUsers == '1' || $roleUsers == '2') {
      return $next($request);
    }
    return response('Accés interdit', 401);
  }


}
