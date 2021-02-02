<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\clientList;

class clientListController extends Controller{

    public function createClientList(Request $request){
/**
     * function createClientList
     * Créé une nouvelle liste de clients dans la table appointment et renvoie un message d'erreur si nécessaire
     * @param Request civility, firstname, lastname, phone, mail, houseOrApartement, buyOrRental, city,
     * ray, budget, digicode, balcony, garden, basement, furniture, elevator, garage, parking
     * @param User TOKEN in header
     * @return json avec les infos de la liste des clients et message de confirmation ainsi que le code HTML 201 et 409
     */
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
            $clientList->civility = $request->input('civility');
            $clientList->firstname = $request->input('firstname');
            $clientList->lastname = $request->input('lastname');
            $clientList->phone = $request->input('phone');
            $clientList->mail = $request->input('mail');
            $clientList->houseOrApartement = $request->input('houseOrApartement');
            $clientList->buyOrRental = $request->input('buyOrRental');
            $clientList->city = $request->input('city');
            $clientList->ray = $request->input('ray');
            $clientList->budget = $request->input('budget');
            $clientList->digicode = $request->input('digicode');
            $clientList->balcony = $request->input('balcony');
            $clientList->garden = $request->input('garden');
            $clientList->basement = $request->input('basement');
            $clientList->furniture = $request->input('furniture');
            $clientList->elevator = $request->input('elevator');
            $clientList->garage = $request->input('garage');
            $clientList->parking = $request->input('parking');
            $clientList->id_tfv042119_user = auth()->user()->id;
            $clientList->id_tfv042119_status = 1;

            $clientList->save();

            return response()->json(['appointement' => $clientList, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Le rendez-vous n\'a pas été enregistré'], 409);
        }


    }     

    // public function deleteClientList(){

    // } 

    // public function getClientListDetail (){

    // } 
}