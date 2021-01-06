<?php
namespace App\Http\Controllers;

use App\Models\estimate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class estimateControllerAuth extends Controller{
    public function __construct(){
        $this->middleware('roleDeux');
    }

    public function createEstimate(Request $request){
        $estimate = estimate::create($request->all());
        return response()->json($estimate, 201);
    }
    public function deleteEstimate($id){
        $estimate = estimate::findOrFail($id);
    }
    public function estimateList(){
        $estimateList = estimate::where('id_tfv042119_user', 1)->get();
        return response()->json($estimateList, 200);
    }
}