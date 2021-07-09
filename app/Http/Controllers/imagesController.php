<?php

namespace App\Http\Controllers;

use App\Models\images;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class imagesController extends Controller{
    


	public function uploadrealestateImg(Request $request)
    {

        $media = storage_path('app/estateImg');
        if ($request->hasFile('img')) {
            $original_filename = $request->file('img')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            // $destination_path = './upload/realEstate/';
            $image = 'U-' . time() . "_" . $original_filename ;
            if ($request->file('img')->move($media, $image)) {
                $img = new images;
                $img->title = $image;
                $img->image = $image;
                $img->id_tfv042119_real_estate = $request->input('id_tfv042119_real_estate');
                $img->save();
 
                return response()->json(['status' => 'success ' . $image], 200);
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