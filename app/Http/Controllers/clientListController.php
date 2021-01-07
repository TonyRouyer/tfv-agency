<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\clientList;

class clientList extends Controller{

    public function createClientList(Request $request){


        $this->validate($request, [
            'civility' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'mail' => 'required|email',
            'houseOrApartement' => 'required|boolean',
            'buyOrRental' => 'required|boolean',
            'city' => 'required',
            'ray' => 'required|alpha',
            'budget' => 'required|alpha',
            'digicode' => 'required|boolean',
            'balcony' => 'required|boolean',
            'garden' => 'required|boolean',
            'basement' => 'required|boolean',
            'furniture' => 'required|boolean',
            'elevator' => 'required|boolean',
            'garage' => 'required|boolean',
            'parking' => 'required|boolean',
            'id_tfv042119_user' => 'required|alpha',
            'id_tfv042119_status' => 'required|alpha'
          ]);
        try {
            $clientList = new clientList;


            // finir fonction a partir d'ici
            $appointement->dateTime = $request->input('dateTime');
            $appointement->label = $request->input('label');
            $appointement->id_tfv042119_user = auth()->user()->id;
            $appointement->save();
            return response()->json(['appointement' => $appointement, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Le rendez-vous n\'a pas été enregistré'], 409);
        }


    }     

    public function deleteClientList(){

    } 

    public function getClientListDetail (){

    } 
}