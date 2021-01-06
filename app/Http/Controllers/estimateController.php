<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class estimateController extends Controller{
    

    public function createEstimate(Request $request){
        $estimate = estimate::create($request->all());
        return response()->json($estimate, 201);
    }

    public function updateEstimate($id, Request $request){
        try{
            $estimate = estimate::findOrFail($id);
            $estimate->update($request->all());
            return response()->json($estimate,200);
        }catch(ModelNotFoundException $e){
            return response()->json('estimation non trouvée',404);
        }
    }

        
    public function showEstimate($id){
        try{
            $estimate = estimate::findOrFail($id);
            $estimate = App\Estimate::has($request->all())->get();
            return response()->json($estimate,200);
        }catch(ModelNotFoundException $e){
            return response()->json('estimation non trouvée',404);
        }
    }

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





    public function __construct(){
        $this->middleware('role');
    }
    public function createEstimate(Request $request){
        $estimate = estimate::create($request->all());
        return response()->json($estimate, 201);
    }



    
    public function __construct(){
        $this->middleware('roleTrois');
    }
    public function validateEstimate($id){
        try{
            $estimate = estimate::findOrFail($id);
            $estimate->update(['id_tfv042119_user'=> 1]);
            return response()->json('estimation a été publiée',200);
        }catch(ModelNotFoundException $e){
            return response()->json('estimation non trouvée',404);
        }
    }
}