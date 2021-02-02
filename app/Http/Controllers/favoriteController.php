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
     * fonction addFavorite
     * Permet d'ajouter une ligne dans la table favorite, l'id de l'user et ajouter automatiquement
     * @param Request id de l'annonce qui doit être ajouté en favoris
     * @return Json Retourne un message de confirmation pour la création du favoris
     */
    public function addFavorite(Request $request, $id) {
            $favorite = new favorites;

            $favorite->id_tfv042119_user = auth()->user()->id;
            $favorite->id_tfv042119_real_estate = $id;
            
            $favorite->save();

            return response()->json(['favorite' => $favorite, 'message' => 'CREATED'], 201);
    }
    /**
     * fonction deleteCall
     * Supprime la ligne dans la table favorites définie par l'id
     * @param Request id de la ligne
     * @return Json Retourne un message de confirmation avec le code HTTP 200 ou 404
     */
    public function deleteFavorite($id){
        try{
            $favorite = favorites::findOrFail($id);
            $favorite->delete();
            $result = response()->json(['message' => 'le favoris a été supprimé'], 200);
            return $result;
        }catch(ModelNotFoundException $e){
            return response()->json('Favoris non trouvé',404);
        }
    }
    /**
     * fonction getFavorieList
     * Retourne la liste de tous les favoris de l'utilisateur en fonction de son TOKEN)
     * @param Request TOKEN de l'utilisateur
     * @return Json Retourne la liste des favoris de l'utilisateur et le code HTTP 200
     */
   
    public function getFavorieList(Request $request){
        $favorite = favorites::where('id_tfv042119_user', auth()->user()->id)->get();
        return response()->json($favorite, 200);
    }
}