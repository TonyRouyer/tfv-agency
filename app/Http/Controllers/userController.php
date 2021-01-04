<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class userController extends Controller
{


   public function UpdateUsers($id, Request $request)
  {
      $userUpdate = user::findOrFail($id);
      $userUpdate->update($request->all());

     return response()->json($userUpdate, 200);
    }
}
