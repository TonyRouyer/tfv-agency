<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\alert;
use  App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class alertController extends Controller{

    /**
     * function addAlert
     * Ajoute une nouvelle ligne a la table alert
     * @param Request zip, city, bufgerMin , budgetMax, area, houseAppartement
     * @return Json avec messagede confirmation
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
     * function deleteAlert
     * suprimme la ligne dans la table alert definie par l'id
     * @param Request id de la ligne
     * @return Json avec messagede confirmation
     */
    public function deleteAlert($id){
        try{
            $alert = alert::findOrFail($id);
            $alert->delete();
            $result = response()->json(['message' => 'appelle supprimé'], 200);
            return $result;
        }catch(ModelNotFoundException $e){
            return response()->json('Appel non trouvé',404);
        }
    }
    /**
     * function showAllAlert
     * Recupere tout alerte call de la table alert de l'utilisateur
     * 
     * @return Json liste des call
     */
    public function showAllAlert(){
        $alertList = alert::where('id_tfv042119_user', auth()->user()->id)->get();
        return response()->json($alertList, 200);
    }
}