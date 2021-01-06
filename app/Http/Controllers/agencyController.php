<?php

namespace App\Http\Controllers;

use App\Models\agency;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class agencyController extends Controller
{
    
// Création de l'offre
    public function createRealEstate(Request $request){
        $agency = agency::create($request->all());
        return response()->json($agency, 201);
    }
}