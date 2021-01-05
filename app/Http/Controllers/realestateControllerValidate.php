<?php

namespace App\Http\Controllers;

use App\Models\realEstate;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class realestateControllerValidate extends Controller{
    public function __construct(){
        $this->middleware('roleTrois');
    }
    public function validateRealEstate($id){
        try{
            $realEstate = realEstate::findOrFail($id);
            $realEstate->update(['id_tfv042119_status'=> 1]);
            return response()->json('L\'annonce a été publié',200);
        }catch(ModelNotFoundException $e){
            return response()->json('Annonce non trouvé',404);
        }
    }
}