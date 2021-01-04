<?php

namespace App\Http\Controllers;

use App\Models\rental;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class rentalController extends Controller{
    

    public function createRental(Request $request){
        $rental = rental::create($request->all());

        return response()->json($rental, 201);
    }

    public function updateRental($id, Request $request){
        try{
            $rental = rental::findOrFail($id);
            $rental->update($request->all());
            return response()->json($rental,200);
        }catch(ModelNotFoundException $e){
            return response()->json('locataire non trouvé',404);
        }
    }

    public function deleteRental($id){
        try{
            $rental = rental::findOrFail($id);
            $rental->update(['id_tfv042119_management_proposal'=> 2]);
            return response()->json('locataire a été archivé',200);
        }catch(ModelNotFoundException $e){
            return response()->json('locataire non trouvé',404);
        }
    }
    
    public function validateRental($id){
        try{
            $rental = rental::findOrFail($id);
            $rental->update(['id_tfv042119_management_proposal'=> 1]);
            return response()->json('locataire a été publié',200);
        }catch(ModelNotFoundException $e){
            return response()->json('locataire non trouvé',404);
        }
    }

    public function showRental($id){
        try{
            $rental = rental::findOrFail($id);
            return response()->json($rental,200);
        }catch(ModelNotFoundException $e){
            return response()->json('locataire non trouvé',404);
        }
    }

    public function showRentalListPublished(){
        $rentalList = rental::where('id_tfv042119_management_proposal', 1)->get();
        return response()->json($rentalList, 200);
    }
    public function showRentalListArchive(){
        $rentalList = rental::where('id_tfv042119_management_proposal', 2)->get();
        return response()->json($rentalList, 200);
}
}