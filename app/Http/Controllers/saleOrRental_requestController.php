<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use App\Models\saleOrRental_request;

class saleOrRental_requestController extends Controller{
    /**
     *  function addRequest
     * Ajoute une ligne a la table saleOrRental_request, prend plusieur parametre en compte, renvoie un message d'erreur sinon
     * @param Request 'saleOrRental''houseApartment''address''zip''city''mail''phone'
     * @return json avec message inserer = code HTML 201
     */
    public function addRequest(Request $request){
        $this->validate($request, [
            'saleOrRental' => 'required|boolean',
            'houseApartment' => 'required|boolean',
            'address' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'mail' => 'required|email',
            'phone' => 'required'
          ]);
        try {
            $rentalFiles = new saleOrRental_request;

            $rentalFiles->saleOrRental = $request->input('saleOrRental');
            $rentalFiles->houseApartment = $request->input('houseApartment');
            $rentalFiles->address = $request->input('address');
            $rentalFiles->zip = $request->input('zip');
            $rentalFiles->city = $request->input('city');
            $rentalFiles->fullText = $request->input('fullText');
            $rentalFiles->mail = $request->input('mail');
            $rentalFiles->phone =$request->input('phone');
            $rentalFiles->id_tfv042119_status = 1;

            $rentalFiles->save();
            return response()->json(['rentalFiles' => $rentalFiles, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur est survenue'], 409);
        }
    }
    /**
     *  function deleteRequest
     * supprime la ligne dans la table saleOrRentalRequest a l'id indiqué
     * @param Request $id
     * @return json message de confirmation ou echec
     */
    public function deleteRequest($id){
        try{
            $rentalFiles = saleOrRental_request::findOrFail($id)
            ->delete();
            return response()->json('Suppression reussi',200);
        }catch(ModelNotFoundException $e){
            return response()->json('requete non trouvé',404);
        }
    }
    /**
     *  function archiveRequest
     * Place la requete au statue archive et ajoute le proprietaire du token dans le champs user
     * @param $id
     * @return json avec message de confirmation ou erreur
     */
    public function archiveRequest($id) {
        try{
            $rentalFiles = saleOrRental_request::findOrFail($id);
            $rentalFiles->update(['id_tfv042119_status'=> 2, 'id_tfv042119_user' => auth()->user()->id]);
            return response()->json('La requete a été archivé',200);
        }catch(ModelNotFoundException $e){
            return response()->json('requete non trouvé',404);
        }
    }
    /**
     *  function showRequest
     *  affiche les information de la requette a l'id choisie
     * @param $id 
     * @return json  avec message de confirmation ou erreur
     */
    public function showRequest($id){
        try{
            $rentalFiles = saleOrRental_request::findOrFail($id);
            return response()->json($rentalFiles,200);
        }catch(ModelNotFoundException $e){
            return response()->json('requete non trouvé',404);
        }
    }
}