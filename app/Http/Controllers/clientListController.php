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
    /**
     * function deleteClientList
     * Change le status vers archivé de la ligne ($id) dans la table clientList
     * @param Request id de la ligne
     * @return Json message de confirmation avec le code HTML 200 ou 409
     */
    public function deleteClientList($id){
        $clientList = clientList::select('id')->where('id_tfv042119_user', auth()->user()->id)->get();
        $decoded = json_decode($clientList, true);
        foreach($decoded as $d) {
            foreach($d as $clef=>$value) {
                if ($value == $id){
                        $clientList = clientList::findOrFail($id);
                        $clientList->update(['id_tfv042119_status'=> 2]);
                        return response()->json('Fiche supprimée',200);
                }
            }
        }
        if (!isset($result)){
            return response()->json(['message' => 'Vous n\'avez pas l\'accès !'], 409);
        }
    } 

    /**
     * function getClientListDetail
     * Récupère les informations de la ligne choisies avec l'id, si il a été créé par l'utilisateur lié au TOKEN
     * @param Request id de la ligne
     * @param Request token
     * @return Json avec les informations recherchées avec le code HTML 200 ou 409
     */
    public function getClientListDetail ($id){
        $clientList = clientList::select('id')->where('id_tfv042119_user', auth()->user()->id)->get();
        $decoded = json_decode($clientList, true);
        foreach($decoded as $d) {
            foreach($d as $clef=>$value) {
                if ($value == $id){
                    $clientList = clientList::where('id', $id);
                    $result = response()->json(['clientList' => $clientList->get()], 200);
                    return $result;
                }
            }
        }
        if (!isset($result)){
            return response()->json(['message' => 'Vous n\'avez pas l\'acces !'], 409);
        }
    } 
    /**
     * function getClientListEmployee
     * récupère les informations clientList de tous les employés de l'agence du TOKEN
     * @param Request id de la ligne
     * @param Request token
     * @return Json avec les informations recherchées
     */
    public function getClientListEmployee(){
        $userInAgency = clientList::join('user', 'user.id', '=', 'clientList.id_tfv042119_user')
        ->where('id_tfv042119_agency', '=', auth()->user()->id_tfv042119_agency)
        ->select(
            'clientList.firstname',
            'clientList.lastname',
            'clientList.phone',
            'clientList.mail',
            'clientList.houseOrApartement',
            'clientList.buyOrRental',
            'clientList.city',
            'clientList.ray',
            'clientList.budget',
            'clientList.digicode',
            'clientList.balcony',
            'clientList.garden',
            'clientList.basement',
            'clientList.furniture',
            'clientList.elevator',
            'clientList.garage',
            'clientList.parking',
        )->get();
    return $userInAgency;
    } 
}