<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class employeeController extends Controller
{
    // Création d'un employé
    public function createEmployee(Request $request)
    {
        $employee = employee::create($request->all());

        return response()->json($employee, 201);
    }

    // retourne la liste des employés au format JSON
    public function getEmployeeList(Request $request)
    {
        return response()->json(employee::all());
    }
}