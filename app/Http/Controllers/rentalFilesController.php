<?php

namespace App\Http\Controllers;

use App\Models\rentalFiles;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class rentalFilesController extends Controller{
    

/**
	 * Méthode nommée "storeFileEntry" au cas où une méthode "store" existe déjà dans le controlleur.
	 */
	public function storeFileEntry(FileUpload $file, User $user) {
	
				
		// Insertion du fichier dans dossier.
		Storage::put($file->getClientOriginalName(), File::get($file->getRealPath()));
		
		// Insertion des informations du fichier en base de données.
		$fileEntry = new FileEntry();
		
		$fileEntry->save();
		
		$fileEntry->fresh();
        return $fileEntry;
	}



}