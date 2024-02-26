<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitantes;
use App\Models\GeneracionEdad;
use App\Helpers\VisitantesHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class VisitantesController extends Controller
{
    public function getVisitantes()
    {
        $get = Visitantes::with('generacion')->get();
        return response()->json($get, 200);
    }

    public function create(Request $request)
    {
        if (empty($request)) {
            return  ['message' => 'Datos vacios'];
        }

        $validator = Validator::make($request->all(), [
            'dui'                  => 'required',
            'nombres'              => 'required',
            'apellidos'            => 'required',
            'email'                => 'required|email',
            'fecha_nacimiento'     => 'required|date',
            'telefono'             => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        DB::beginTransaction();

        try{
            $gen = VisitantesHelper::clasificacionEdad($request->fecha_nacimiento);

            $vis = new Visitantes();
            $vis->dui = $request->dui;
            $vis->nombres = $request->nombres;
            $vis->apellidos = $request->apellidos;
            $vis->fecha_nacimiento = $request->fecha_nacimiento;
            $vis->id_generacion = $gen;
            $vis->telefono = $request->telefono;
            $vis->email    = $request->email;
            $vis->save();


        } catch (\Exception $e) {
            DB::rollback();
            return response()->json('(error: ' . $e->getCode() . ") " . $e->getMessage());
        }
        
        DB::commit();

        return response()->json($vis, 201);
    }
   
}
