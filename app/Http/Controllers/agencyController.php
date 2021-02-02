<?php

namespace App\Http\Controllers;

use App\Models\agency;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class agencyController extends Controller{
    
     /**
     * function createRealEstate
     * Création de l'offre
     * @return json avec l'offre et le code HTTP 201
     */
    public function createRealEstate(Request $request){
        $agency = agency::create($request->all());
        return response()->json($agency, 201);
    }
}