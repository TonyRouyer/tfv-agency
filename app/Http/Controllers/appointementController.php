<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\appointment;

class appointementController extends Controller
{
    /**
     * fonction createAppointement
     * Créé un nouveau RDV dans la table appointement et renvoi un message d'erreur si nécessaire
     * @param Request dateTime, label
     * @param User TOKEN in header
     * @return json Retourne les infos du RDV avec un message de confirmation et le code HTML 201 ou 409
     */
    public function createAppointement(Request $request) {
        $this->validate($request, [
            'dateTime' => 'required|date_format:Y-m-d H:i:s',
            'label' => 'required',
          ]);
        try {
            $appointement = new appointment;
            $appointement->dateTime = $request->input('dateTime');
            $appointement->label = $request->input('label');
            $appointement->id_tfv042119_user = auth()->user()->id;
            $appointement->save();
            return response()->json(['appointement' => $appointement, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Le rendez-vous n\'a pas été enregistré'], 409);
        }
    }
    /**
     * fonction getAppointementList
     * Récupère la liste de tous les RDV que l'utilisateur a créé en fonction de son TOKEN
     * @param User TOKEN in header
     * @return json Retourne les infos du RDV et message de confirmation ainsi que le code HTML 200 ou 409
     */
    public function getAppointementList(){
        $appointement = appointment::where('id_tfv042119_user', auth()->user()->id)->get();
        return response()->json($appointement, 200);
    }
    /**
     * function showAppointementDetail
     * Retrouve les informations d'un rendez-vous créées par l'utilisateur en fonction de l'id recherché avec un message d'erreur si l'id ne corespond pas a un RDV de l'utilisateur
     * @param Request $id du RDV recherché
     * @param User TOKEN in header
     * @return json Retourne les infos du RDV et message de confirmation ainsi que le code HTML 200 ou 409
     */
    public function showAppointementDetail(Request $request, $id) {
        $appointementlist = appointment::select('id')->where('id_tfv042119_user', auth()->user()->id)->get();
        $decoded = json_decode($appointementlist, true);
        foreach($decoded as $d) {
            foreach($d as $clef=>$value) {
                if ($value == $id){
                    $appointment = appointment::where('id', $id);
                    $result = response()->json(['appointment' => $appointment->get()], 200);
                    return $result;
                }
            }
        }
        if (!isset($result)){
            return response()->json(['message' => 'Vous n\'avez pas l\'accès !'], 409);
        }
    }
    /**
     * fonction deleteAppointement
     * Supprime un rendez-vous de l'utilisateur en fonction de l'id recherché, sinon renvoi un message d'erreur
     * @param Request $id du RDV recherché
     * @param User TOKEN in header
     * @return json Retourne les infos du RDV et message de confirmation ainsi que le code HTML 200 ou 409
     */
    public function deleteAppointement(Request $request, $id) {

        $appointementlist = appointment::select('id')->where('id_tfv042119_user', auth()->user()->id)->get();

        $decoded = json_decode($appointementlist, true);

        foreach($decoded as $d) {
            foreach($d as $clef=>$value) {
                if ($value == $id){
                    $appointment = appointment::where('id', $id)->delete();
                    $result = response()->json(['message' => 'RDV supprimé'], 200);
                    return $result;
                }
            }
        }
        if (!isset($result)){
            return response()->json(['message' => 'Vous n\'avez pas l\'accès !'], 409);
        }
    }
    /**
     * fonction updateAppointement
     * Met à jour un RDV en fonction des paramètres, et de l'id. Message d'erreur si l'id ne corespond pas à un RDV créé par l'utilisateur
     * @param Request dateTime, label
     * @param Request $id du RDV recherché
     * @param User TOKEN in header
     * @return json Retourne les infos du RDV ainsi que le message de confirmation et le code HTML 201 ou 409
     */
    public function updateAppointement(Request $request, $id) {
        $this->validate($request, [
            'dateTime' => 'date_format:Y-m-d H:i:s'
          ]);
        $appointementlist = appointment::select('id')->where('id_tfv042119_user', auth()->user()->id)->get();
        $decoded = json_decode($appointementlist, true);
        foreach($decoded as $d) {
            foreach($d as $clef=>$value) {
                if ($value == $id){
                    $appointment = appointment::findOrFail($id);
                    if (null !== $request->input('dateTime')){
                        $appointment->update(['dateTime'=> $request->input('dateTime')]);
                        $result = response()->json(['appointment' => $appointment, 'message' => 'Updated'], 201);
                        return $result;
                    }else if (null !== $request->input('label')){
                        $appointment->update(['label' => $request->input('label')]);
                        $result = response()->json(['appointment' => $appointment, 'message' => 'Updated'], 201);
                        return $result;
                    }else if (null !== $request->input('dateTime') && null !==$request->input('label')){
                        $appointment->update(['dateTime'=> $request->input('dateTime'), 'label' => $request->input('label')]);
                        $result = response()->json(['appointment' => $appointment, 'message' => 'Updated'], 201);
                        return $result;
                    }
                }
            }
        }
        if (!isset($result)){
            return response()->json(['message' => 'Vous n\'avez pas l\'accès !'], 409);
        }
    }
}