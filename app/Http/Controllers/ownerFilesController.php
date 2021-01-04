<?php

namespace App\Http\Controllers;

use App\Models\ownerFiles;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ownerFilesController extends Controller{
    

    public function createOwnerFiles(Request $request){
        $ownerFiles = ownerFiles::create($request->all());

        return response()->json($ownerFiles, 201);
    }

    public function updateOwnerFiles($id, Request $request){
        try{
            $ownerFiles = ownerFiles::findOrFail($id);
            $ownerFiles->update($request->all());
            return response()->json($ownerFiles,200);
        }catch(ModelNotFoundException $e){
            return response()->json('fichiers du propriétaire non trouvés',404);
        }
    }

    public function deleteOwnerFiles($id){
        try{
            $ownerFiles = ownerFiles::findOrFail($id);
            $ownerFiles->update(['id_tfv042119_owner'=> 2]);
            return response()->json('fichiers du propriétaire ont été archivés',200);
        }catch(ModelNotFoundException $e){
            return response()->json('fichiers du propriétaire non trouvés',404);
        }
    }
    
    public function validateOwnerFiles($id){
        try{
            $ownerFiles = ownerFiles::findOrFail($id);
            $ownerFiles->update(['id_tfv042119_owner'=> 1]);
            return response()->json('fichiers du propriétaire ont été publiés',200);
        }catch(ModelNotFoundException $e){
            return response()->json('fichiers du propriétaire non trouvés',404);
        }
    }

    public function showOwnerFiles($id){
        try{
            $ownerFiles = ownerFiles::findOrFail($id);
            return response()->json($ownerFiles,200);
        }catch(ModelNotFoundException $e){
            return response()->json('fichiers du propriétaire non trouvés',404);
        }
    }

    public function showOwnerFilesListPublished(){
        $ownerFilesList = ownerFiles::where('id_tfv042119_owner', 1)->get();
        return response()->json($ownerFilesList, 200);
    }
    public function showOwnerFilesListArchive(){
        $ownerFilesList = ownerFiles::where('id_tfv042119_owner', 2)->get();
        return response()->json($ownerFilesList, 200);
}
}