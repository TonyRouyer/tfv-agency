<?php

namespace App\Http\Controllers;

use App\Models\realEstate;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class realestateControllerShowDetail extends Controller{
    public function __construct(){
        $this->middleware('role');
    }
    public function showRealEstateDetail($id){
        try{
            $realEstate = realEstate::findOrFail($id);
            return response()->json($realEstate,200);
        }catch(ModelNotFoundException $e){
            return response()->json('bien non trouvé',404);
        }
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
}