<?php
namespace App\Http\Controllers;

use App\Models\managementProposal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class managementProposalController extends Controller{
        
     /**
     * fonction createManagementProposal
     * Créer dans la table managementProposal, renvoi un message d'erreur si nécessaire
     * @param Request type, address, city, zip(n°département), fullText
     * @param User TOKEN in header
     * @return json Retourne un message de confirmation avec le code HTML 201 ou 409
     */
    public function createManagementProposal(Request $request) {
        $this->validate($request, [
            'type' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'fullText' => 'required'
            ]);
        try {
            $managementProposal = new managementProposal;

            $managementProposal->type = $request->input('type');
            $managementProposal->address = $request->input('address');
            $managementProposal->city = $request->input('city');
            $managementProposal->zip = $request->input('zip');
            $managementProposal->fullText = $request->input('fullText');
            $managementProposal->id_tfv042119_user = auth()->user()->id;
            $managementProposal->id_tfv042119_user_owner_have_management_proposal = $request->input('id_tfv042119_user_owner_have_management_proposal');
            $managementProposal->id_tfv042119_user_rental_have_management_proposal = $request->input('id_tfv042119_user_rental_have_management_proposal');

            $managementProposal->save();
            return response()->json(['managementProposal' => $managementProposal, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Mise en gestion non enregistrée'], 409);
        }
    }
    /**
     * fonction getManagementProposalList
     * Récupère la liste des mises en gestion locative que l'utilisateur a créé en fonction de son TOKEN
     * @param User TOKEN in header
     * @return json Retourne un message de confirmation avec le code HTML 200
     */
    public function getManagementProposalList(){
        $managementProposal = managementProposal::where('id_tfv042119_user', auth()->user()->id)
        ->orWhere('id_tfv042119_user_owner_have_management_proposal', auth()->user()->id)
        ->orWhere('id_tfv042119_user_rental_have_management_proposal', auth()->user()->id)
        ->get();
        return response()->json($managementProposal, 200);
    }
    /**
     * fonction showManagementProposalDetail
     * Retrouve les informations d'une mise en gestion locative créées par l'utilisateur en fonction de l'id recherché et message d'erreur si l'id ne correspond pas à une mise en gestion de l'utilisateur
     * @param Request $id de la mise en gestion recherchée
     * @param User TOKEN in header
     * @return json Retourne un message de confirmation avec le code HTML 200 ou 409
     */
    public function showManagementProposalDetail(Request $request, $id) {
        $managementProposalList = managementProposal::select('id')
        ->where('id_tfv042119_user', auth()->user()->id)
        ->orWhere('id_tfv042119_user_owner_have_management_proposal', auth()->user()->id)
        ->orWhere('id_tfv042119_user_rental_have_management_proposal', auth()->user()->id)
        ->get();
        $decoded = json_decode($managementProposalList, true);
        foreach($decoded as $d) {
            foreach($d as $clef=>$value) {
                if ($value == $id){
                    $managementProposal = managementProposal::where('id', $id);
                    $result = response()->json(['managementProposal' => $managementProposal->get()], 200);
                    return $result;
                }
            }
        }
        if (!isset($result)){
            return response()->json(['message' => 'Droits insuffisants'], 409);
        }
    }
    /**
     * fonction deleteManagementProposal
     * Mettre en archive la mise en gestion de l'utilisateur en fonction de l'id recherché, sinon renvoi un message d'erreur
     * @param Request $id de la mise en gestion recherchée
     * @param User TOKEN in header
     * @return json Retourne un message de confirmation ainsi que le code HTML 200 ou 409
     */
    public function deleteManagementProposal(Request $request, $id) {

        $managementProposalList = managementProposal::select('id')->where('id_tfv042119_user', auth()->user()->id)->get();

        $decoded = json_decode($managementProposalList, true);

        foreach($decoded as $d) {
            foreach($d as $clef=>$value) {
                if ($value == $id){
                    $managementProposal = managementProposal::where('id', $id)->delete();
                    $result = response()->json(['mise en gestion' => ' supprimé'], 200);
                    return $result;
                }
            }
        }
        if (!isset($result)){
            return response()->json(['message' => 'Droits insuffisants'], 409);
        }
    }
    /**
     * fonction updateManagementProposal
     * Met à jour la mise en gestion locative en fonction des paramètres, et de l'id. Message d'erreur si l'id ne correspond pas à une mise en gestion créé par l'utilisateur
     * Récupère la liste des biens en gestion locative créé par le proprietaire du TOKEN et si l'id ne correspond pas à l'un de cela on affiche une erreur
     * @param Request fullText
     * @param Request $id de la mise en gestion recherchée
     * @param User TOKEN in header
     * @return json Retourne un message de confirmation ainsi que le code HTML 201 ou 409
     */
    public function updateManagementProposal(Request $request, $id) {
        $this->validate($request, [
           'fullText' => 'string'
          ]);
        $managementProposalList = managementProposal::select('id')->where('id_tfv042119_user', auth()->user()->id)->get();
        $decoded = json_decode($managementProposalList, true);
        foreach($decoded as $d) {
            foreach($d as $clef=>$value) {
                if ($value == $id){
                    $managementProposal = managementProposal::findOrFail($id);
                    if (null !== $request->input('fullText')){
                        $managementProposal->update(['fullText'=> $request->input('fullText')]);
                        $result = response()->json(['managementProposal' => $managementProposal, 'message' => 'Updated'], 201);
                        return $result;
                    }
                }
            }
        }
        if (!isset($result)){
            return response()->json(['message' => 'Droits insuffisants'], 409);
        }
    }
    }
     