<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
//import auth facades
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  
  public function register(Request $request)
  {
    //validate incoming request
    $this->validate($request, [
      'lastname' => 'required|string',
      'firstname' => 'required|string',
      'mail' => 'required|email|unique:users',
      'password' => 'required|confirmed',
      'avatar' => 'required',
      'id_tfv042119_role' => 'required',
    ]);

    try {
      //on instancie
      $user = new User;
      //stock et récupére les données des input
      $user->lastname = $request->input('lastname');
      $user->firstname = $request->input('firstname');
      $user->mail = $request->input('mail');
      $plainPassword = $request->input('password');
      //on hash le mot de passe
      $user->password = app('hash')->make($plainPassword);
      $user->avatar = $request->input('avatar');
      $user->id_tfv042119_role = $request->input('id_tfv042119_role');
      // sauvegarde les données (les envoies)
      $user->save();

      //return successful response
      return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

    } catch (\Exception $e) {
      //return error message
      return response()->json(['message' => 'User Registration Failed!'], 409);
    }

  }


  public function login(Request $request)
  {
    //validate incoming request
    $this->validate($request, [
      'mail' => 'required|string',
      'password' => 'required|string',
    ]);
    //stock dans $credentials,email et password
    $credentials = $request->only(['mail', 'password']);
    //si l'authentification est réussi, sa stocke le token dans $token et nous return la function respondWithToken, sinon a nous affiche un message d'érreur
    if (! $token = Auth::attempt($credentials)) {
      return response()->json(['message' => 'Unauthorized'], 401);
    }
// ! a enlever
    return $this->respondWithToken($token);
  }


}
