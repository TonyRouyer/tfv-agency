<?php

namespace App\Http\Controllers;

use App\Models\managementProposal;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class managementProposalController extends Controller{
    
    public function register(Request $request)
    {
      //validate incoming request
      $this->validate($request, [
        'type' => 'required|boolean',
        'address' => 'required|string',
        'zip' => 'required|string',
        'city' => 'required|string',
        'fullTExt' => 'required|string',
        ]);
  
      try {
        //on instancie
        $managementProposal = new ManagementProposal;
        //stock et récupére les données des input
        $managementProposal->type = $request->input('type');
        $managementProposal->address = $request->input('address');
        $managementProposal->zip = $request->input('zip');
        $managementProposal->city = $request->input('city');
        $managementProposal->fullText = $request->input('fullText');
        // sauvegarde les données (les envoies)
        $managementProposal->save();
  
        //return successful response
        return response()->json(['managementProposal' => $managementProposal, 'message' => 'CREATED'], 201);
  
      } catch (\Exception $e) {
        //return error message
        return response()->json(['message' => 'Error Registration Failed!'], 409);
      }
  
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
    
    public function validateManagementProposal($id){
        try{
            $managementProposal = managementProposal::findOrFail($id);
            $managementProposal->update(['id_tfv042119_employee'=> 1]);
            return response()->json('mise en gestion a été publié',200);
        }catch(ModelNotFoundException $e){
            return response()->json('mise en gestion non trouvé',404);
        }
    }

    public function showManagementProposal($id){
        try{
            $managementProposal = managementProposal::findOrFail($id);
            return response()->json($managementProposal,200);
        }catch(ModelNotFoundException $e){
            return response()->json('mise en gestion non trouvé',404);
        }
    }

    public function showManagementProposalListPublished(){
        $managementProposalList = managementProposal::where('id_tfv042119_employee', 1)->get();
        return response()->json($managementProposalList, 200);
    }
    public function showManagementProposalListArchive(){
        $managementProposalList = managementProposal::where('id_tfv042119_employee', 2)->get();
        return response()->json($managementProposalList, 200);
}
}