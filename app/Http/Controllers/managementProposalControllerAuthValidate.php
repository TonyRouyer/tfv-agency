<?php
namespace App\Http\Controllers;

use App\Models\managementProposal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class managementProposalControllerAuthValidate extends Controller{
    public function __construct(){
        $this->middleware('roleTrois');
    }

    public function validateManagementProposal($id){
        try{
            $managementProposal = managementProposal::findOrFail($id);
            $managementProposal->update(['id_tfv042119_employee'=> 1]);
            return response()->json('mise en gestion a été publiée',200);
        }catch(ModelNotFoundException $e){
            return response()->json('mise en gestion non trouvée',404);
        }
    }

}