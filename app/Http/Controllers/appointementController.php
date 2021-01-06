<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\appointment;

class appointementController extends Controller
{
     /**
     * Instantiate a new UserController instance.
     */

    public function __construct()
    {
        $this->middleware('role');
    }
   
    public function UpdateAppointement() {
        //recuperer le RDV du l'user en cours pour le modifier

        if (Auth::check()){
        $appointement = Auth::appointment();

        $appointement->dateTime = $request->input('dateTime');
        $appointement->label = $request->input('label');
        $appointement->id_tfv042119_employee = $request->input('employeeId');
        $appointement->save();
        return response()->json($appointement, 200);
        }else{
            return response()->json(['message' => 'Appointement not found!'], 404);
        }
    }


    public function getAppointementList(){
        $appointement = appointment::where('id_tfv042119_employee', auth()->employee()->id)
        ->get();
        return response()->json($house, 200);
    }

}