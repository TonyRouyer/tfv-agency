<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
//import auth facades
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController{
    //function qui renvoie le token+date expiration + type + renvoie le code 200
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



// public function uploadImage(Request $request){
//     if ($request->hasFile('a')) {
//         $original_filename = $request->file('a')->getClientOriginalName();
//         $original_filename_arr = explode('.', $original_filename);
//         $file_ext = end($original_filename_arr);
//         $destination_path = './upload/user/';
//         $image = 'U-' . time() . '.' . $file_ext;

//         if ($request->file('a')->move($destination_path, $image)) {
//             // $user->image = '/upload/user/' . $image;
//             return response()->json(['status' => 'success'], 200);
//         } else {
//             return response()->json('Cannot upload file',404);
//         }
//     }   else {
//         return response()->json('File not found',404);
//         }
//     }