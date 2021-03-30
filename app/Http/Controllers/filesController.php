<?php

namespace App\Http\Controllers;

use App\Models\files;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class filesController extends Controller{
    
/**
     * fonction uploadImage
     * Ajoute une image dans la base de données
     * @param Request hasFile permettant de constituer le fichier (nom du fichier et son extension).
     * @param Request file permettant de déplacer le fichier dans le dossier temporaire vers son répertoire de destination.
     * @return Json Retourne un message de confirmation avec le code HTTP 200 ou 404
     */
// fonction ok, a ajouter check type fichier (img, pdf).((type mime)) ? ajouter filtre taille max
// document name != Title
	public function uploadFiles(Request $request)
    {
        $media = storage_path('app/managementProposalFiles');
        if ($request->hasFile('a')) {
            $original_filename = $request->file('a')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $image = 'U-' . time() . '.' . $file_ext;

            if ($request->file('a')->move($media, $image)) {


			   $files = new files;
			   $files->documentName = $image;
			   $files->title = $image;
			   $files->id_tfv042119_user =  auth()->user()->id;
			   $files->id_tfv042119_management_proposal = $request->input('id_tfv042119_management_proposal');
			   $files->save();

               return response()->json(['status' => 'success'], 200);
            } else {
                return response()->json('Cannot upload file',404);
            }
        } else {
            return response()->json('File not found',404);
        }
	}
    public function getFiles($id) {
        $imgList = files::where('id_tfv042119_management_proposal', $id)->get();
        return response()->json(['managementProposalImg' => $imgList], 200);
    }



}