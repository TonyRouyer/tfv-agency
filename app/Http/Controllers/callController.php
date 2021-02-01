<?php

namespace App\Http\Controllers;

use App\Models\call;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class callController extends Controller{
    /**
     * function addCall
     * ajoute une nouvelle ligne a la table call
     * @param Request lastname , firstname , mail, avaibility, preferenceCall , phone (non obligatoire), message (non obligatoire)
     * @return Json avec messagede confirmation
     */
    public function addCall(Request $request) {
        $this->validate($request, [
            'lastname' => 'required',
            'firstname' => 'required',
            'mail' => 'required|email',
            //'availability' => 'required',
            'preferenceCall' => 'required',
            'phone' => ['regex:#^((0|\+33 ?)[1-9])([ -.]?)(([0-9]{2})([ \-.]?)){4}$#']

          ]);
        try {
            $call = new call;

            $call->lastname = $request->input('lastname');
            $call->firstname = $request->input('firstname');
            $call->mail = $request->input('mail');
            $call->availability = $request->input('availability');
            $call->preferenceCall = $request->input('preferenceCall');
            $call->phone = $request->input('phone');
            $call->message = $request->input('message');
            $call->id_tfv042119_status = '4';

            $call->save();

            return response()->json(['call' => $call, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur est survenue'], 409);
        }
    }
    /**
     * function deleteCall
     * suprimme la ligne dans la table Call definie par l'id
     * @param Request id de la ligne
     * @return Json avec messagede confirmation
     */
    public function deleteCall($id){
        try{
            $call = call::findOrFail($id);
            $call->delete();
            $result = response()->json(['message' => 'appelle supprimé'], 200);
            return $result;
        }catch(ModelNotFoundException $e){
            return response()->json('Appel non trouvé',404);
        }
    }
    /**
     * function showOnecall
     * recupere la liste du call definie par l'id
     * @param Request id de la ligne
     * @return Json avec le contenue recherché
     */
    public function showOnecall($id){
        try{
            $call = call::findOrFail($id);
            return response()->json($call,200);
        }catch(ModelNotFoundException $e){
            return response()->json('appel non trouvé',404);
        }
    }
    /**
     * function showAllCall
     * Recupere tout showAllCall call de la table Call
     * 
     * @return Json liste des call
     */
    // a optimiser pour afficher que les apelle de une agence en particulier
    public function showAllCall(){
        $callList = call::where('id_tfv042119_status', 4)->get();
        return response()->json($callList, 200);
    }

}