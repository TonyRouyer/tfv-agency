<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\favorites;
use  App\Models\User;
use  App\Models\realEstate;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class favoriteController extends Controller{
    /**
     * function addFavorite
     * ajoute une ligne dans la table favorite, l'id de l'user et ajouter automatiquement
     * @param Request id de l'annonce qui doit être ajouter en favorie
     * @return Json avec messagede confirmation
     */
    public function addFavorite(Request $request, $id) {
            $favorite = new favorites;

            $favorite->id_tfv042119_user = auth()->user()->id;
            $favorite->id_tfv042119_real_estate = $id;
            
            $favorite->save();

            return response()->json(['favorite' => $favorite, 'message' => 'CREATED'], 201);
    }
    /**
     * function deleteCall
     * suprimme la ligne dans la table favorites definie par l'id
     * @param Request id de la ligne
     * @return Json avec messagede confirmation
     */
    public function deleteFavorite($id){
        try{
            $favorite = favorites::findOrFail($id);
            $favorite->delete();
            $result = response()->json(['message' => 'le favorie a ete supprime'], 200);
            return $result;
        }catch(ModelNotFoundException $e){
            return response()->json('Favorie non trouvé',404);
        }
    }
    /**
     * function getFavorieList
     * Retourne la liste de tout les favorie de lutilisateur en fonction de son token)
     * @param Request token de l'utilisateur
     * @return Json liste des favorie de l'utilisateur
     */
   
    public function getFavorieList(Request $request){
        $favorite = favorites::where('id_tfv042119_user', auth()->user()->id)->get();
        return response()->json($favorite, 200);
    }

}