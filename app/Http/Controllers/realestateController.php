<?php

namespace App\Http\Controllers;

use App\Models\realEstate;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class realEstateController extends Controller{
    
    // public function showAllRealEstate()
    // {
    //     return response()->json(realEstate::all());
    // }

    // public function showOneRealEstate($id)
    // {
    //     try{
    //         $toto = realEstate::findOrFail($id);
    //     return response()->json($toto,200);
    // }catch(ModelNotFoundException $e){
    //     return response()->json('Bien non trouvé',404);
    // }
    // }
    public function createRealEstate(Request $request){
        $realEstate = realEstate::create($request->all());

        return response()->json($realEstate, 201);
    }
    public function updateRealEstate($id, Request $request){
        try{
            $realEstate = realEstate::findOrFail($id);
            $realEstate->update($request->all());
            return response()->json($realEstate,200);
        }catch(ModelNotFoundException $e){
            return response()->json('bien non trouvé',404);
        }
    }
    public function deleteRealEstate($id){
        // try{
        //     $realEstate = realEstate::findOrFail($id);
        //     $realEstate->delete();
        //     return response()->json('Le bien a été supprimé',200);
        // }catch(ModelNotFoundException $e){
        //     return response()->json('bien non trouvé',404);
        // }
        try{
            $realEstate = realEstate::findOrFail($id);
            $realEstate->update(['id_tfv042119_status'=> 2]);
            return response()->json('Le fichier a été archivé',200);
        }catch(ModelNotFoundException $e){
            return response()->json('bien non trouvé',404);
        }
    }
}