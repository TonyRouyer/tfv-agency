<?php

namespace App\Http\Controllers;

use App\Models\realEstate;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class real_estateController extends Controller
{
    
    public function showAllRealEstate()
    {
        return response()->json(realEstate::all());
    }

    public function showOneRealEstate($id)
    {
        try{
            $toto = realEstate::findOrFail($id);
        return response()->json($toto,200);
    }catch(ModelNotFoundException $e){
        return response()->json('Bien non trouvé',404);
    }
    }

    public function createRealEstate(Request $request)
    {
        $realEstate = realEstate::create($request->all());

        return response()->json($realEstate, 201);
    }

    // public function updateRealEstate($id, Request $request)
    // {
    //     $realEstate = real_estate::findOrFail($id);
    //     $realEstate->update($request->all());

    //     return response()->json($realEstate, 200);
    // }

    // public function deleteRealEstate($id)
    // {
    //     real_estate::findOrFail($id)->delete();
    //     return response('Deleted Successfully', 200);
    // }
}