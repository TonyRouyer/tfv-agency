<?php

namespace App\Http\Controllers;

use App\Models\owner;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ownerController extends Controller{
    

    public function createOwner(Request $request){
        $owner = owner::create($request->all());

        return response()->json($owner, 201);
    }

    public function updateOwner($id, Request $request){
        try{
            $owner = owner::findOrFail($id);
            $owner->update($request->all());
            return response()->json($owner,200);
        }catch(ModelNotFoundException $e){
            return response()->json('propriétaire non trouvé',404);
        }
    }

    public function deleteOwner($id){
        try{
            $owner = owner::findOrFail($id);
            $owner->update(['id_tfv042119_management_proposal'=> 2]);
            return response()->json('propriétaire a été archivé',200);
        }catch(ModelNotFoundException $e){
            return response()->json('propriétaire non trouvé',404);
        }
    }
    
    public function validateOwner($id){
        try{
            $owner = owner::findOrFail($id);
            $owner->update(['id_tfv042119_management_proposal'=> 1]);
            return response()->json('propriétaire a été publié',200);
        }catch(ModelNotFoundException $e){
            return response()->json('propriétaire non trouvé',404);
        }
    }

    public function showOwner($id){
        try{
            $owner = owner::findOrFail($id);
            return response()->json($owner,200);
        }catch(ModelNotFoundException $e){
            return response()->json('propriétaire non trouvé',404);
        }
    }

    public function showOwnerListPublished(){
        $ownerList = owner::where('id_tfv042119_management_proposal', 1)->get();
        return response()->json($ownerList, 200);
    }
    public function showOwnerListArchive(){
        $ownerList = owner::where('id_tfv042119_management_proposal', 2)->get();
        return response()->json($ownerList, 200);
}
}