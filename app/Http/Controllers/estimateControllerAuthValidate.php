<?php
namespace App\Http\Controllers;

use App\Models\estimate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class estimateControllerAuthValidate extends Controller{
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