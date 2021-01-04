<?php

namespace App\Http\Controllers;

use App\Models\rentalFiles;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class rentalFilesController extends Controller{
    

    public function createRentalFiles(Request $request){
        $rentalFiles = rentalFiles::create($request->all());

        return response()->json($rentalFiles, 201);
    }

    public function updateRentalFiles($id, Request $request){
        try{
            $rentalFiles = rentalFiles::findOrFail($id);
            $rentalFiles->update($request->all());
            return response()->json($rentalFiles,200);
        }catch(ModelNotFoundException $e){
            return response()->json('fichiers du locataire non trouvés',404);
        }
    }

    public function deleteRentalFiles($id){
        try{
            $rentalFiles = rentalFiles::findOrFail($id);
            $rentalFiles->update(['id_tfv042119_rental'=> 2]);
            return response()->json('fichiers du locataire ont été archivés',200);
        }catch(ModelNotFoundException $e){
            return response()->json('fichiers du locataire non trouvé',404);
        }
    }
    
    public function validateRentalFiles($id){
        try{
            $rentalFiles = rentalFiles::findOrFail($id);
            $rentalFiles->update(['id_tfv042119_rental'=> 1]);
            return response()->json('fichiers du locataire ont été publiés',200);
        }catch(ModelNotFoundException $e){
            return response()->json('fichiers du locataire non trouvés',404);
        }
    }

    public function showRentalFiles($id){
        try{
            $rentalFiles = rentalFiles::findOrFail($id);
            return response()->json($rentalFiles,200);
        }catch(ModelNotFoundException $e){
            return response()->json('fichiers du locataire non trouvés',404);
        }
    }

    public function showRentalFilesListPublished(){
        $rentalFilesList = rentalFiles::where('id_tfv042119_rental', 1)->get();
        return response()->json($rentalFilesList, 200);
    }
    public function showRentalFilesListArchive(){
        $rentalFilesList = rentalFiles::where('id_tfv042119_rental', 2)->get();
        return response()->json($rentalFilesList, 200);
}
}