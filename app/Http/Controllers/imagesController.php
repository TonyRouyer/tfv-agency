<?php

namespace App\Http\Controllers;

use App\Models\images;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class imagesController extends Controller{
    


	public function uploadrealestateImg(Request $request)
    {
        if ($request->hasFile('a')) {
            $original_filename = $request->file('a')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload/realEstate/';
            $image = 'U-' . time() . '.' . $file_ext;

            if ($request->file('a')->move($destination_path, $image)) {

			   $img = new images;
			   $img->title = $image;
			   $img->image = $image;
			   $img->id_tfv042119_real_estate = $request->input('id_tfv042119_real_estate');
			   $img->save();

               return response()->json(['status' => 'success'], 200);
            } else {
                return response()->json('Cannot upload file',404);
            }
        } else {
            return response()->json('File not found',404);
        }
    }
    
    public function getRealestateImg($id) {
        $imgList = images::where('id_tfv042119_real_estate', $id)->get();
        return response()->json(['imgList' => $imgList], 200);
    }






}