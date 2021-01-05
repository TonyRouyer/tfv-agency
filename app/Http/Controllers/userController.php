<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use  App\Models\User;

class UserController extends Controller
{
     /**
     * Instantiate a new UserController instance.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    //$id, Request $request
    public function UpdateUsers(Request $request, $id) 
     {
        $userUpdate= user::findOrFail($id);

        $userUpdate->lastname = $request->input('lastname');
        $userUpdate->firstname = $request->input('firstname');
        $userUpdate->mail = $request->input('mail');
        $userUpdate->password = $request->input('password');
        $userUpdate->avatar = $request->input('avatar');
        $userUpdate->save();
        return response()->json($userUpdate, 200);
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
