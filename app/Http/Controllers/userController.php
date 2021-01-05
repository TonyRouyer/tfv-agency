<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
     /**
     * Instantiate a new UserController instance.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function UpdateUsers(Request $request, $id) //$id, Request $request
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
        $user->id_tfv042119_role = $request->input('id_tfv042119_role');

        $user->save();

            return response()->json($user, 200);
            return response()->json(['message' => 'user not found!'], 404);

        }

    }



    /**
     * Get the authenticated User.
     */

    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }

    /**
     * Get all User.
     */

    public function allUsers()
    {
         return response()->json(['users' =>  User::all()], 200);
    }

    /**
     * Get one user.
     */

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
