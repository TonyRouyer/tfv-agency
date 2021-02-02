<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
//Importation du fichier auth en façades
  use Illuminate\Support\Facades\Auth;

  class Controller extends BaseController{
    /**
     * fonction respondWithToken
     * Renvoi un TOKEN, date d'expiration, le type et renvoi un message d'erreur si nécessaire
     * @return json Retourne un Json du type de TOKEN et du TOKEN ainsi que le code HTML 200
     */
   
    protected function respondWithToken($token)
    {
      return response()->json([
        'token' => $token,
        'token_type' => 'bearer',
      //  'date d'expiration' => Auth::factory()->getTTL() * 60
        'expires_in' => auth('api')->factory()->getTTL() * 1
      ], 200);
    }
  }
