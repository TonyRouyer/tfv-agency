<?php

namespace App\Http\Controllers;

use App\Models\realEstate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Auth\Factory as Auth;


class realEstateController extends Controller{
     /**
     * function createRealEstate
     * crée un nouveau bien dans la table real estate, prend en compte une liste de paramètres
     * @param Request         referencePublishing,houseApartment,SaleOrRental,title,fullText,coverImage,address,zip,city,complement,price,area,numberOfPieces,digicode,furniture,balcony,elevator,garden,garage,parking,cellar
     * @return json avec les informations saisie et le code HTML 201
     */  
    public function createRealEstate(Request $request){
        $employeeAgency = auth()->user()->id_tfv042119_agency;
        $realEstate = realEstate::create([
        'referencePublishing' => $request->input('referencePublishing'),
        'houseApartment'  => $request->input('houseApartment'),
        'SaleOrRental'  => $request->input('SaleOrRental'), 
        'title'  => $request->input('title'),      
        'fullText'  => $request->input('fullText'),     
        'coverImage'  => $request->input('coverImage'),          
        'address'  => $request->input('address'),
        'zip'  => $request->input('zip'),
        'city'  => $request->input('city'),
        'complement'  => $request->input('complement'),  
        'price'  => $request->input('price'),      
        'area'  => $request->input('area'),  
        'numberOfPieces'  => $request->input('numberOfPieces'),
        'digicode'  => $request->input('digicode'),
        'furniture'  => $request->input('furniture'), 
        'balcony'  => $request->input('balcony'),       
        'elevator'  => $request->input('elevator'),
        'garden'  => $request->input('garden'),  
        'garage'  => $request->input('garage'),   
        'parking'  => $request->input('parking'),
        'cellar'  => $request->input('cellar'),      
        'id_tfv042119_status'  => 3,  
        'id_tfv042119_agency'  => $employeeAgency,
        ]);
        return response()->json(['realestate' => $realEstate], 201);
    }



    public function deleteRealEstate($id){
        try{
            $realEstate = realEstate::findOrFail($id);
            $realEstate->update(['id_tfv042119_status'=> 2]);
            return response()->json('Le fichier a été archivé',200);
        }catch(ModelNotFoundException $e){
            return response()->json('bien non trouvé',404);
        }
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
