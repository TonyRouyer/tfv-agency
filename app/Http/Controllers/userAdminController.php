<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class userAdminController extends Controller
{
     /**
     * Instantiate a new UserController instance.
     */

    public function __construct()
    {
        $this->middleware('roleUsers');
    }

    public function register(Request $request)
    {
      //validate incoming request
      $this->validate($request, [
        'lastname' => 'required|string',
        'firstname' => 'required|string',
        'mail' => 'required|email|unique:user',
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
        //on hash le mot de passe avec la make méthode
        $user->password = app('hash')->make($plainPassword);
        $user->avatar = $request->input('avatar');
        $user->id_tfv042119_role = $request->input('id_tfv042119_role');
        // sauvegarde les données (les envoies)
        $user->save();

        //return successful response
        return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

      } catch (\Exception $e) {
        //return error message
        return response()->json(['message' => 'Inscription non aboutie'], 409);
      }

    }



    public function allUsers()
    {
         return response()->json(['users' =>  User::all()], 200);
    }


    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json(['user' => $user], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'user not found!'], 404);
        }

    }


}
