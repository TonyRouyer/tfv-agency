<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{

//Update de l'utilisateur en se moment connecté en vérifiant le token (que le token lui apartienne bien)

/**
* Function pour update l'utilisateur
* $user = @var int, @var string
*
*
*/
    public function UpdateUsers(Request $request)
     {
        if (Auth::check()){
            //permet de verifier si l'utilisateur est authentifié

        $user = Auth::user();
        $user->lastname = $request->input('lastname');
        $user->firstname = $request->input('firstname');
        $user->mail = $request->input('mail');
        $plainPassword = $request->input('password');
        //on hash le mot de passe
        $user->password = app('hash')->make($plainPassword);
        $user->avatar = $request->input('avatar');
        $user->id_tfv042119_role = 6;

        $user->save();

               return response()->json($user, 200);
        }
    }

//permet de récupérer le profil d'un utilisateur en fonction de son token
    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }


/*
*
* PARTIE ADMIN
*
*/


//insertion d'un employer seulement par l'admin ou par le chef d'agence grace au middleware
    public function registerEmployee(Request $request)
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

//permet de récupérer la liste de tout les utlisateurs en fonction du token
    public function allUsers()
    {
         return response()->json(['users' =>  User::all()], 200);
    }

//permet de récupérer un utlisateurs en fonction du token
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
