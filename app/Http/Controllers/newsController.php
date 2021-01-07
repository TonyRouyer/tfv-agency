<?php
namespace App\Http\Controllers;

use App\Models\news;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class newsController extends Controller{
     /**
     * function showNews
     * Recupere une news en fonction de son id
     * @param Request id de la news
     * @return json avec les information de la news
     */
    public function showNews($id){
        try{
            $news = news::findOrFail($id);
            return response()->json($news,200);
        }catch(ModelNotFoundException $e){
            return response()->json('article non trouvé',404);
        }
    }
     /**
     * function showNewsListPublished
     * Recupere la liste de tous les article qui on été publié
     * @return json avec la liste de tous les news
     */
    public function showNewsListPublished(){
        $newsList = news::where('id_tfv042119_status', 1)->get();
        return response()->json($newsList, 200);
    }
     /**
     * function createNews
     * Crée une nouvelle news
     * @return json avec la news et le code HTTP 200
     */
    public function createNews(Request $request){
        $news = news::create($request->all());
        return response()->json($news, 201);
    }
     /**
     * function updateNews
     * Met a jour une news en fonction de son id, ou une erreur si l'id est incorecte
     * @return json avec la news et le code HTTP 200
     */
    public function updateNews($id, Request $request){
        try{
            $news = news::findOrFail($id);
            $news->update($request->all());
            return response()->json($news,200);
        }catch(ModelNotFoundException $e){
            return response()->json('article non trouvé',404);
        }
    }
     /**
     * function deleteNews
     * Supprime une news en fonction de son id, ou une erreur si l'id est incorecte
     * @return json avec la news et le code HTTP 200
     */
    public function deleteNews($id){
        try{
            $news = news::findOrFail($id);
            $news->update(['id_tfv042119_status'=> 2]);
            return response()->json('L\'article a été archivé',200);
        }catch(ModelNotFoundException $e){
            return response()->json('article non trouvé',404);
        }
    }
     /**
     * function showNewsListArchive
     * Récupère la liste de toutes les news avec le statue archivé
     * @return json avec les news et le code HTTP 200
     */
    public function showNewsListArchive(){
        $newsList = news::where('id_tfv042119_status', 2)->get();
        return response()->json($newsList, 200);
    }
     /**
     * function validateNews
     * Change le statue d'une news vers publié (1), en fonction de l'id de la news, renvois un message d'erreur si id incorrecte
     * @return json avec message de confirmation de code HTML 200
     */
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