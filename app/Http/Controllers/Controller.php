<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
//Importation du fichier auth en façades
  use Illuminate\Support\Facades\Auth;

  class Controller extends BaseController
  {
    //fonction qui renvoie le TOKEN + date expiration + type + renvoie le code 200
    protected function respondWithToken($token)
    {
      return response()->json([
        'token' => $token,
        'token_type' => 'bearer',
      //  'expires_in' => Auth::factory()->getTTL() * 60
        'expires_in' => auth('api')->factory()->getTTL() * 1
      ], 200);
    }

  }
