<?php
namespace App\Http\Controllers;

use App\Models\news;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class newsControllerAuthValidate extends Controller{
    public function __construct(){
        $this->middleware('roleTrois');
    }

    public function validateNews($id){
        try{
            $news = news::findOrFail($id);
            $news->update(['id_tfv042119_status'=> 1]);
            return response()->json('L\'article a été publié',200);
        }catch(ModelNotFoundException $e){
            return response()->json('article non trouvé',404);
        }
    }

}