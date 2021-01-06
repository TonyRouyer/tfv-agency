<?php
namespace App\Http\Controllers;

use App\Models\estimate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class estimateControllerAuthCreate extends Controller{
    public function __construct(){
        $this->middleware('role');
    }
    public function createEstimate(Request $request){
        $estimate = estimate::create($request->all());
        return response()->json($estimate, 201);
    }
}