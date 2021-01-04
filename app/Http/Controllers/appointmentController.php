<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class appointmentController extends Controller{
    

    public function createAppointment(Request $request){
        $appointment = appointment::create($request->all());

        return response()->json($appointment, 201);
    }

    public function updateAppointment($id, Request $request){
        try{
            $appointment = appointment::findOrFail($id);
            $appointment->update($request->all());
            return response()->json($appointment,200);
        }catch(ModelNotFoundException $e){
            return response()->json('rendez-vous non trouvé',404);
        }
    }

    public function deleteAppointment($id){
        try{
            $appointment = appointment::findOrFail($id);
            $appointment->update(['id_tfv042119_employee'=> 2]);
            return response()->json('rendez-vous a été archivé',200);
        }catch(ModelNotFoundException $e){
            return response()->json('rendez-vous non trouvé',404);
        }
    }
    
    public function validateAppointment($id){
        try{
            $appointment = appointment::findOrFail($id);
            $appointment->update(['id_tfv042119_employee'=> 1]);
            return response()->json('rendez-vous a été publié',200);
        }catch(ModelNotFoundException $e){
            return response()->json('rendez-vous non trouvé',404);
        }
    }

    public function showAppointment($id){
        try{
            $appointment = appointment::findOrFail($id);
            return response()->json($appointment,200);
        }catch(ModelNotFoundException $e){
            return response()->json('rendez-vous non trouvé',404);
        }
    }

    public function showAppointmentListPublished(){
        $appointmentList = appointment::where('id_tfv042119_employee', 1)->get();
        return response()->json($appointmentList, 200);
    }
    public function showAppointmentListArchive(){
        $appointmentList = appointment::where('id_tfv042119_employee', 2)->get();
        return response()->json($appointmentList, 200);
}
}