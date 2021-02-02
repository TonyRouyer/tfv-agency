<?php
namespace App\Http\Controllers;

use App\Models\news;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class newsController extends Controller{
     /**
     * fonction showNews
     * Récupère une news en fonction de son id
     * @param Request id de la news
     * @return json Retourne les informations de la news avec un message de confirmation et le code 404
     */
    public function showNews($id){
        try{
            $news = news::findOrFail($id);
            return response()->json($news,200);
        }catch(ModelNotFoundException $e){
            return response()->json('Article non trouvé',404);
        }
    }
     /**
     * fonction showNewsListPublished
     * Récupère la liste de tous les articles qui a été publiée
     * @return json Retourne la liste de toutes les news avec le code HTTP 200
     */
    public function showNewsListPublished(){
        $newsList = news::where('id_tfv042119_status', 1)->orderBy('datePublishing', 'desc')->get();
        return response()->json($newsList, 200);
    }
     /**
     * function createNews
     * Crée une nouvelle news,
     * @param "title(varchar), a (img) , fullText(varchar), datePublishing (sql datetime) , author (varchar)";
     * @return json avec la news et le code HTTP 201
     */
    public function createNews(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'fullText' => 'required',
            'author' => 'required'
          ]);
            $news = new news;
            $news->title = $request->input('title');
            $news->fullText = $request->input('fullText');
            if ($request->hasFile('a')) {
                $original_filename = $request->file('a')->getClientOriginalName();
                $original_filename_arr = explode('.', $original_filename);
                $file_ext = end($original_filename_arr);
                $destination_path = './upload/news/';
                $image = 'U-' . time() . '.' . $file_ext;
                if ($request->file('a')->move($destination_path, $image)) {
                    $news->imageNews = $image;
                } else {
                    return response()->json('Cannot upload file',404);
                }
            } else {
                $news->imageNews = 'exemple.png';
            }
            $news->datePublishing = date("Y-m-d H:i:s");
            $news->author = $request->input('author');
            $news->id_tfv042119_status = 4;
            $news->save();
            return response()->json($news, 201);
        }
     /**
     * fonction updateNews
     * Met à jour une news en fonction de son id et renvoi une erreur si l'id est incorrect
     * @return json Retourne les infos de la news avec un message de confirmation ainsi que le code HTTP 200 ou 404
     */
    public function updateNews($id, Request $request){
        try{
            $news = news::findOrFail($id);
            $news->update($request->all());
            return response()->json($news,200);
        }catch(ModelNotFoundException $e){
            return response()->json('Article non trouvé',404);
        }
    }
     /**
     * fonction deleteNews
     * Supprime une news en fonction de son id et renvoi une erreur si l'id est incorrect
     * @return json Retourne les infos de la news ainsi que le message de confirmation avec le code HTTP 200 ou 404
     */
    public function deleteNews($id){
        try{
            $news = news::findOrFail($id);
            $news->update(['id_tfv042119_status'=> 2]);
            return response()->json('L\'article a été archivé',200);
        }catch(ModelNotFoundException $e){
            return response()->json('Article non trouvé',404);
        }
    }
     /**
     * fonction showNewsListArchive
     * Récupère la liste de toutes les news avec le status "archivé"
     * @return json Retourne toutes les infos de news et le code HTTP 200
     */
    public function showNewsListArchive(){
        $newsList = news::where('id_tfv042119_status', 2)->orderBy('datePublishing', 'desc')->get();
        return response()->json($newsList, 200);
    }
     /**
     * fonction validateNews
     * Change le status d'une news vers publié (1), en fonction de l'id de la news et renvoi un message d'erreur si id est incorrect
     * @return json Retourne un message de confirmation avec le code HTML 200 ou 404
     */
    public function validateNews($id){
        try{
            $news = news::findOrFail($id);
            $news->update(['id_tfv042119_status'=> 1]);
            return response()->json('L\'article a été publié',200);
        }catch(ModelNotFoundException $e){
            return response()->json('Article non trouvé',404);
        }
    }
}