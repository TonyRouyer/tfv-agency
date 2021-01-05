<?php
namespace App\Http\Controllers;

use App\Models\managementProposal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class managementProposalControllerAuthCreate extends Controller{
    public function __construct(){
        $this->middleware('role');
    }
    public function createManagementProposal(Request $request){
        $managementProposal = managementProposal::create($request->all());
        return response()->json($managementProposal, 201);
    }
}