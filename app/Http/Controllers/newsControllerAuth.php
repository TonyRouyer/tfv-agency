<?php
namespace App\Http\Controllers;

use App\Models\news;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class newsControllerAuth extends Controller{
    public function __construct(){
        $this->middleware('roleDeux');
    }

    public function createNews(Request $request){
        $news = news::create($request->all());
        return response()->json($news, 201);
    }
    public function updateNews($id, Request $request){
        try{
            $news = news::findOrFail($id);
            $news->update($request->all());
            return response()->json($news,200);
        }catch(ModelNotFoundException $e){
            return response()->json('article non trouvé',404);
        }
    }
    public function deleteNews($id){
        try{
            $news = news::findOrFail($id);
            $news->update(['id_tfv042119_status'=> 2]);
            return response()->json('L\'article a été archivé',200);
        }catch(ModelNotFoundException $e){
            return response()->json('article non trouvé',404);
        }
    }
    public function showNewsListArchive(){
        $newsList = news::where('id_tfv042119_status', 2)->get();
        return response()->json($newsList, 200);
    }
}