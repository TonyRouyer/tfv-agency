<?php
namespace App\Http\Controllers;

use App\Models\managementProposal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class managementProposalController extends Controller{
        
     /**
     * function createManagementProposal
     * Crée un nouveau RDV dans la table appointement, renvois un message d'erreur si il y en a une.
     * @param Request dateTime , label
     * @param User token in header
     * @return json avec les info du RDV, message de confirmation , et le code HTML 200
     */
    public function createManagementProposal(Request $request) {
        $this->validate($request, [
            'type' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'fullText' => 'required',
            'id_tfv042119_user' => 'required'
            ]);
        try {
            $managementProposal = new managementProposal;
            $managementProposal->type = $request->input('type');
            $managementProposal->address = $request->input('address');
            $managementProposal->city = $request->input('city');
            $managementProposal->zip = $request->input('zip');
           $managementProposal->fullText = $request->input('fullText');
            $managementProposal->id_tfv042119_user = auth()->user()->id;
            $managementProposal->save();
            return response()->json(['managementProposal' => $managementProposal, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Mise en gestion non enregistrée'], 409);
        }
    }
    /**
     * function getManagementProposalList
     * recupere la liste des mises en gestion que l'utilisateur a crée en fonction de son token
     * @param User token in header
     * @return json avec les infos du RDV, message de confirmation , et le code HTML 200
     */
    public function getManagementProposalList(){
        $managementProposal = managementProposal::where('id_tfv042119_user', auth()->user()->id)->get();
        return response()->json($managementProposal, 200);
    }
    /**
     * function showManagementProposalDetail
     * Retrouve les informations d'une mise en gestion créé par l'utilisateur en fonction de l'id recherché, message d'erreur si l'id ne correspond pas à une mise en gestion de l'utilisateur
     * @param Request $id de la mise en gestion recherché
     * @param User token in header
     * @return json avec les infos de la mise en gestion, message de confirmation , et le code HTML 200
     */
    public function showManagementProposalDetail(Request $request, $id) {
        $managementProposalList = managementProposal::select('id')->where('id_tfv042119_user', auth()->user()->id)->get();
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
     * function deleteManagementProposal
     * Mettre en archive la mise en gestion de l'utilisateur en fonction de l'id recherché, sinon renvoi un message d'erreur.
     * @param Request $id de la mise en gestion recherchée
     * @param User token in header
     * @return json avec les infos de la mise en gestion, message de confirmation , et le code HTML 200
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
     * function updateManagementProposal
     * Met à jour de la mise en gestion en fonction des paramètres, et de l'id. message d'erreur si l'id ne corespond pas à une mise en gestion crée par l'utilisateur
     * @param Request type , address , zip , city , fullText
     * @param Request $id de la mise en gestion recherchée
     * @param User token in header
     * @return json avec les infos de la mise en gestion, message de confirmation , et le code HTML 200
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
                        $appointment->update(['fullText'=> $request->input('fullText')]);
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
     