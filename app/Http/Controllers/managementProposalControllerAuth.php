<?php
namespace App\Http\Controllers;

use App\Models\managementProposal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class managementProposalControllerAuth extends Controller{
    public function __construct(){
        $this->middleware('roleDeux');
    }

    public function createManagementProposal(Request $request){
        $managementProposal = managementProposal::create($request->all());
        return response()->json($managementProposal, 201);
    }
    public function updateManagementProposal($id, Request $request){
        try{
            $managementProposal = managementProposal::findOrFail($id);
            $managementProposal->update($request->all());
            return response()->json($managementProposal,200);
        }catch(ModelNotFoundException $e){
            return response()->json('mise en gestion non trouvé',404);
        }
    }
    public function deleteManagementProposal($id){
        try{
            $managementProposal = managementProposal::findOrFail($id);
            $managementProposal->update(['id_tfv042119_employee'=> 2]);
            return response()->json('mise en gestion a été archivé',200);
        }catch(ModelNotFoundException $e){
            return response()->json('mise en gestion non trouvé',404);
        }
    }
    public function showManagementProposalListArchive(){
        $managementProposalList = managementProposal::where('id_tfv042119_employee', 2)->get();
        return response()->json($managementProposalList, 200);
    }
}