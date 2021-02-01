<?php

namespace App\Http\Controllers;

use App\Models\files;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class filesController extends Controller{
    
    public function store(Request $request, User $user) {
		$file = $request->file('file');
		
		$fileEntry = $this->storeFileEntry($file, $user);
		
		$file = new files();
		$file->user_id = $user->id;
		$file->fileEntry_id = $fileEntry->id;
		$file->save();
	}

}