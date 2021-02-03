<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use App\Models\saleOrRental_request;

class saleOrRental_requestController extends Controller{
    /**
     * fonction addRequest
     * Ajoute une ligne à la table saleOrRental_request, prend plusieurs paramètres en compte, sinon renvoi un message d'erreur
     * @param Request 'saleOrRental''houseApartment''address''zip''city''mail''phone'
     * @return json Retourne un message de confirmation avec le code HTML 201 ou 409
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
     * fonction deleteRequest
     * Supprime la ligne dans la table saleOrRentalRequest à l'id indiqué
     * @param Request $id
     * @return json Retourne un message de confirmation avec le code HTML 200 ou 404
     */
    public function deleteRequest($id){
        try{
            $rentalFiles = saleOrRental_request::findOrFail($id)
            ->delete();
            return response()->json('Suppression réussie',200);
        }catch(ModelNotFoundException $e){
            return response()->json('requête non trouvée',404);
        }
    }
    /**
     * fonction archiveRequest
     * Place la requête au status archivé et ajoute le proprietaire du TOKEN dans le champ user
     * @param $id
     * @return json Retourne un message de confirmation avec un code HTML 200 ou 404
     */
    public function archiveRequest($id) {
        try{
            $rentalFiles = saleOrRental_request::findOrFail($id);
            $rentalFiles->update(['id_tfv042119_status'=> 2, 'id_tfv042119_user' => auth()->user()->id]);
            return response()->json('La requête a été archivée',200);
        }catch(ModelNotFoundException $e){
            return response()->json('requête non trouvée',404);
        }
    }
    /**
     * fonction showRequest
     * Affiche les informations de la requête à l'id choisi
     * @param $id 
     * @return json Retourne un message de confirmation avec un code HTML 200 ou 404
     */
    public function showRequest($id){
        try{
            $rentalFiles = saleOrRental_request::findOrFail($id);
            return response()->json($rentalFiles,200);
        }catch(ModelNotFoundException $e){
            return response()->json('requête non trouvée',404);
        }
    }
    /**
     * fonction showSaleRequest
     * Affiche toute les requete qui concerne une vente
     * @param $id 
     * @return json Retourne un message de confirmation avec un code HTML 200 ou 404
     */
    public function showSaleRequest(){
        try{
            $rentalFiles = saleOrRental_request::where('saleOrRental', 0)->get();

            return response()->json($rentalFiles,200);
        }catch(ModelNotFoundException $e){
            return response()->json('requête non trouvée',404);
        }
    }
    /**
     * fonction showRentalRequest
     * Affiche toute les requete qui concerne une vente
     * @param $id 
     * @return json Retourne un message de confirmation avec un code HTML 200 ou 404
     */
    public function showRentalRequest(){
        try{
            $rentalFiles = saleOrRental_request::where('saleOrRental', 1)->get();

            return response()->json($rentalFiles,200);
        }catch(ModelNotFoundException $e){
            return response()->json('requête non trouvée',404);
        }
    }
} 