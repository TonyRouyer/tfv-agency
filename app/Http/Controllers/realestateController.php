<?php

namespace App\Http\Controllers;

use App\Models\realEstate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Auth\Factory as Auth;


class realEstateController extends Controller{
     /**
     * Fonction createRealEstate
     * création d'un nouveau bien dans la table realEstate, prend en compte une liste de paramètres
     * @param Request referencePublishing, houseApartment, SaleOrRental, title, fullText, coverImage, address, zip, city, complement, price, area, numberOfPieces, digicode, furniture, balcony, elevator, garden, garage, parking, cellar
     * @return json Retourne les informations saisie avec le code HTML 201
     */  
    public function createRealEstate(Request $request){
        $employeeAgency = auth()->user()->id_tfv042119_agency;

        if ($request->hasFile('coverImg')) {
            $original_filename = $request->file('coverImg')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload/realEstateCover/';
            $image = 'RE-' . time() . '.' . $file_ext;
            if ($request->file('coverImg')->move($destination_path, $image)) {
    
                $estateCover = $image;
            } else {
                return response()->json('Cannot upload file',404);
            }
        } else {
                $estateCover = 'noCover.png';
        }

        $realEstate = realEstate::create([
        'referencePublishing' => $request->input('referencePublishing'),
        'houseApartment'  => $request->input('houseApartment'),
        'SaleOrRental'  => $request->input('SaleOrRental'), 
        'title'  => $request->input('title'),      
        'fullText'  => $request->input('fullText'),  
        
        

        'coverImage'  => $estateCover,     
        

        
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

/**
     * Fonction deleteRealEstate
     * Mettre en archive le bien de la table realEstate en fonction de l'id recherché, sinon renvoi un message d'erreur
     * @param Request $id du bien recherché
     * @param User TOKEN in header
     * @return json Retourne un message de confirmation ainsi que le code HTML 200 ou 404
     */

    public function deleteRealEstate($id){
        try{
            $realEstate = realEstate::findOrFail($id);
            $realEstate->update(['id_tfv042119_status'=> 2]);
            return response()->json('Le fichier a été archivé',200);
        }catch(ModelNotFoundException $e){
            return response()->json('bien non trouvé',404);
        }
    }

    /**
     * fonction validateRealEstate
     * Validation de l'annonce
     * @param Request $id de l'annonce recherchée
     * @param User TOKEN in header
     * @return json Retourne un message de confirmation ainsi que le code HTML 201 ou 404
     */

    public function validateRealEstate($id){
        try{
            $realEstate = realEstate::findOrFail($id);
            $realEstate->update(['id_tfv042119_status'=> 1]);
            return response()->json('L\'annonce a été publiée',200);
        }catch(ModelNotFoundException $e){
            return response()->json('Annonce non trouvée',404);
        }
    }
/**
     * fonction showRealEstateDetail
     * Retrouve les informations d'un bien créées par l'utilisateur en fonction de l'id recherché et message d'erreur si l'id ne correspond pas à un bien de l'utilisateur
     * @param Request $id de la mise en gestion recherchée
     * @param User TOKEN in header
     * @return json Retourne un message de confirmation avec le code HTML 200 ou 404
     */

    public function showRealEstateDetail($id){
        try{
            $realEstate = realEstate::findOrFail($id);
            return response()->json($realEstate,200);
        }catch(ModelNotFoundException $e){
            return response()->json('bien non trouvé',404);
        }
    }

    /**
     * fonction updateRealEstate
     * Met à jour le bien en fonction des paramètres, et de l'id. Message d'erreur si l'id ne correspond pas à un bien créé par l'utilisateur
     * Récupère la liste des biens créé par le proprietaire du TOKEN et si l'id ne correspond pas à l'un de cela on affiche une erreur
     * @param Request referencePublishing, houseApartment, SaleOrRental, title, fullText, coverImage, address, zip, city, complement, price, area, numberOfPieces, digicode, furniture, balcony, elevator, garden, garage, parking, cellar
     * @param Request $id du bien recherché
     * @param User TOKEN in header
     * @return json Retourne un message de confirmation ainsi que le code HTML 201 ou 409
     */

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
