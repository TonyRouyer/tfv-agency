<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class appointmentController extends Controller{
    
// Création d'un rendez-vous
    public function createAppointment(Request $request){
        $appointment = appointment::create($request->all());

        return response()->json($appointment, 201);
    }

    // Modifier un rendez-vous
    public function updateAppointment($id, Request $request){
        try{
            $appointment = appointment::findOrFail($id);
            $appointment->update($request->all());
            return response()->json($appointment,200);
        }catch(ModelNotFoundException $e){
            return response()->json('rendez-vous non trouvé',404);
        }
    }

    // Mettre le rendez-vous en archive
    public function deleteAppointment($id){
        try{
            $appointment = appointment::findOrFail($id);
            $appointment->update(['id_tfv042119_user'=> 2]);
            return response()->json('rendez-vous a été archivé',200);
        }catch(ModelNotFoundException $e){
            return response()->json('rendez-vous non trouvé',404);
        }
    }
    
    // Valider le rendez-vous
    public function validateAppointment($id){
        try{
            $appointment = appointment::findOrFail($id);
            $appointment->update(['id_tfv042119_user'=> 1]);
            return response()->json('rendez-vous a été publié',200);
        }catch(ModelNotFoundException $e){
            return response()->json('rendez-vous non trouvé',404);
        }
    }

    // Liste des rendez-vous
    public function showAppointment($id){
        try{
            $appointment = appointment::findOrFail($id);
            return response()->json($appointment,200);
        }catch(ModelNotFoundException $e){
            return response()->json('rendez-vous non trouvé',404);
        }
    }

    // Liste des rendez-vous publiés
    public function showAppointmentListPublished(){
        $appointmentList = appointment::where('id_tfv042119_user', 1)->get();
        return response()->json($appointmentList, 200);
    }

    // Liste des rendez-vous archivés
    public function showAppointmentListArchive(){
        $appointmentList = appointment::where('id_tfv042119_user', 2)->get();
        return response()->json($appointmentList, 200);
}
}