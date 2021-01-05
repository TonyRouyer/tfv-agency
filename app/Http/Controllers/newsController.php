<?php
namespace App\Http\Controllers;

use App\Models\news;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class newsController extends Controller{
    public function showNews($id){
        try{
            $news = news::findOrFail($id);
            return response()->json($news,200);
        }catch(ModelNotFoundException $e){
            return response()->json('article non trouvé',404);
        }
    }
    public function showNewsListPublished(){
        $newsList = news::where('id_tfv042119_status', 1)->get();
        return response()->json($newsList, 200);
    }
}