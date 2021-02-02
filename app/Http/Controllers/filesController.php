<?php

namespace App\Http\Controllers;

use App\Models\files;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class filesController extends Controller{
    

// fonction ok, a ajouter check type fichier (img, pdf).((type mime)) ? ajouter filtre taille max
// document name != Title
	public function uploadImage(Request $request)
    {
        if ($request->hasFile('a')) {
            $original_filename = $request->file('a')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload/user/';
            $image = 'U-' . time() . '.' . $file_ext;

            if ($request->file('a')->move($destination_path, $image)) {
			   // $user->image = '/upload/user/' . $image;

			   $files = new files;
			   $files->documentName = $image;
			   $files->title = $image;
			   $files->id_tfv042119_user =  auth()->user()->id;
			   $files->id_tfv042119_management_proposal = $request->input('management_proposal');
			   $files->save();

               return response()->json(['status' => 'success'], 200);
            } else {
                return response()->json('Cannot upload file',404);
            }
        } else {
            return response()->json('File not found',404);
        }
	}

//  ne marche pas / recupere vide
    public function getFiles(Request $request){
		$files = files::where('id_tfv042119_management_proposal', $request->input('id'));
		return response()->json($files, 200);
		
    }



}