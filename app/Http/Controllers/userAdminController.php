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
        $this->middleware('roleUsers');

    }

    /**
     * Get all User.
     */

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
