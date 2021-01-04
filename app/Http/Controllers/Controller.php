<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
//import auth facades
  use Illuminate\Support\Facades\Auth;

  class Controller extends BaseController
  {
    //function qui renvoie le token+date expiration + type + renvoie le code 200
    protected function respondWithToken($token)
    {
      return response()->json([
        'token' => $token,
        'token_type' => 'bearer',
        'expires_in' => Auth::factory()->getTTL() * 60
      ], 200);
    }

  }
