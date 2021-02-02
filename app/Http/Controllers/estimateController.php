<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\dataPrice;

class estimateController extends Controller{
    /**
     * function createEstimate
     * Création d'une estimation dans la table dataprice et renvoi un message d'erreur si nécessaire
     * @param Request area, city, zip (n° dpartement), , mail
     * @param User TOKEN in header
     * @return json Retourne les infos du RDV ains que le message de confirmation et le code HTML 201 ou 409
     */
    public function createEstimate(Request $request){
        //on récupère les infos soumisent dans chaque champ
        $area = $request->input('area');
        $city = $request->input('city');
        $zip =  $request->input('zip');
        $dpe =  $request->input('dpe');
        $mail = $request->input('mail');

        //on récupère les infos qu'on met dans $data
        $data = dataPrice::where('NOM_COM', 'LIKE', "$city%")
        ->where('INSEE_DEP' , $zip)
        ->get();

        if (null !== $data){
            //on décode le JSON pour extraire le prix
            $json = json_decode($data,true);
            
            if (!empty($json[0]['Prixm2'])){
                $estimation = $json[0]['Prixm2'] * $request->input('area');

                
                //à finir envoi de mail si présent
        
                    return response()->json(['estimation' => $estimation . ' euros'], 200);
            }else {
                $estimation = 2500 * $request->input('area');
                return response()->json(['estimation' => $estimation . ' euros'], 200);


            }
        }else {
            return response()->json(['message' => 'ville inconnue'], 404);
        }












              
    }





    // public function updateEstimate($id, Request $request){
    //     try{
    //         $estimate = estimate::findOrFail($id);
    //         $estimate->update($request->all());
    //         return response()->json($estimate,200);
    //     }catch(ModelNotFoundException $e){
    //         return response()->json('estimation non trouvée',404);
    //     }
    // }

        
    // public function showEstimate($id){
    //     try{
    //         $estimate = estimate::findOrFail($id);
    //         $estimate = App\Estimate::has($request->all())->get();
    //         return response()->json($estimate,200);
    //     }catch(ModelNotFoundException $e){
    //         return response()->json('estimation non trouvée',404);
    //     }
    // }

    //     public function __construct(){
    //     $this->middleware('roleDeux');
    // }

    // public function createEstimate(Request $request){
    //     $estimate = estimate::create($request->all());
    //     return response()->json($estimate, 201);
    // }
    // public function deleteEstimate($id){
    //     $estimate = estimate::findOrFail($id);
    // }
    // public function estimateList(){
    //     $estimateList = estimate::where('id_tfv042119_user', 1)->get();
    //     return response()->json($estimateList, 200);
    // }





    // public function __construct(){
    //     $this->middleware('role');
    // }
    // public function createEstimate(Request $request){
    //     $estimate = estimate::create($request->all());
    //     return response()->json($estimate, 201);
    // }



    
    // public function __construct(){
    //     $this->middleware('roleTrois');
    // }
    // public function validateEstimate($id){
    //     try{
    //         $estimate = estimate::findOrFail($id);
    //         $estimate->update(['id_tfv042119_user'=> 1]);
    //         return response()->json('estimation a été publiée',200);
    //     }catch(ModelNotFoundException $e){
    //         return response()->json('estimation non trouvée',404);
    //     }
    // }
}