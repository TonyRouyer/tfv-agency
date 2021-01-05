<?php
namespace App\Http\Controllers;

use App\Models\news;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class newsControllerAuthCreate extends Controller{
    public function __construct(){
        $this->middleware('role');
    }
    public function createNews(Request $request){
        $news = news::create($request->all());
        return response()->json($news, 201);
    }
}