<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\alert;
use  App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class alertController extends Controller{

    /**
     * fonction addAlert
     * Ajoute une nouvelle ligne à la table alert
     * @param Request zip(n°departement), city, bufgerMin , budgetMax, area, houseAppartement
     * @return Json Retourne un message de confirmation avec le code HTTP 201
     */
    public function addAlert(Request $request) {
        $this->validate($request, [
            'zip' => 'required|numeric',
            'city' => 'required|alpha_dash',
            'budgetMin' => 'required|numeric',
            'budgetMax' => 'required|numeric',
            'area' => 'required|numeric',
            'houseApartment' => 'required|boolean'

          ]);
        
        $alert = new alert;
        $alert->dateAlert = date("Y-m-d H:i:s");
        $alert->zip = $request->input('zip');
        $alert->city = $request->input('city');
        $alert->budgetMin = $request->input('budgetMin');
        $alert->budgetMax = $request->input('budgetMax');
        $alert->area = $request->input('area');
        $alert->houseApartment = $request->input('houseApartment');
        $alert->id_tfv042119_user = auth()->user()->id;
        
        $alert->save();

        return response()->json(['alert' => $alert, 'message' => 'CREATED'], 201);
    }
    /**
     * fonction deleteAlert
     * Supprime la ligne dans la table alert défini par l'id
     * @param Request id de la ligne
     * @return Json Retourne un message de confirmation avec le code HTTP 200 ou 404
     */
    public function deleteAlert($id){
        // try{
        //     $alert = alert::findOrFail($id);
        //     $alert->delete();
        //     $result = response()->json(['message' => 'appel supprimé'], 200);
        //     return $result;
        // }catch(ModelNotFoundException $e){
        //     return response()->json('Appel non trouvé',404);
        // }

        $alertList = alert::select('id')->where('id_tfv042119_user', auth()->user()->id)->get();

        $decoded = json_decode($alertList, true);

        foreach($decoded as $d) {
            foreach($d as $clef=>$value) {
                if ($value == $id){
                    $alert = alert::where('id', $id)->delete();
                    $result = response()->json(['message' => 'Alerte supprimé'], 200);
                    return $result;
                }
            }
        }
        if (!isset($result)){
            return response()->json(['message' => 'Vous n\'avez pas l\'accès !'], 409);
        }

    }
    /**
     * fonction showAllAlert
     * Récupère toutes les alertes dans la table call de l'utilisateur
     * 
     * @return Json Retourne la liste des appels et le code HTML 200
     */
    public function showAllAlert(){
        $alertList = alert::where('id_tfv042119_user', auth()->user()->id)->get();
        return response()->json($alertList, 200);
    }
}