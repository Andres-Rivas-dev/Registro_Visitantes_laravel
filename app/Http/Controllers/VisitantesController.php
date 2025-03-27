<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitantes;
use App\Models\GeneracionEdad;
use App\Models\cotizacion_tipo_estados;
use App\Helpers\VisitantesHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            'telefono'             => 'required|integer|min:8',
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

    public function FPGetDiasBloqueados (Request $request){

        if (empty($request)) {
            return  ['message' => 'Datos vacios'];
        }

        $validator = Validator::make($request->all(), [
            'Plataforma'                  => 'nullable',
            'NombreEstado'                => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        DB::beginTransaction();

        try{

           // dd($request->Plataforma);

            $get = cotizacion_tipo_estados::where('CT_PLATAFORMA', $request->Plataforma)->get();

            $res = [
                "resultado" => "00",
            ];

            foreach ($get as $value) {
                $res[] = [
                    "id"                => $value->CT_ID,
                    "Plataforma"	    => $value->CT_PLATAFORMA,
                    "NombreEstado"	    => $value->CT_NOMBRE_ESTADO,
                    "Estado"	        => $value->Campo ,
                    "DiasBloqueados"	 => $value->CT_DIAS_BLOQUEADOS	,
                    "FechaModificacion"	 => $value->CT_FECHA_MODIFICACION	

                ];

               // $res[] = $RES;
            } 

            /* $vis = Visitantes::where('dui', $request->dui)->first();
            $vis->estado = 0;
            $vis->save(); */

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json('(error: ' . $e->getCode() . ") " . $e->getMessage());
        }
        
        DB::commit();

        return response()->json($res, 200);

    }
   
}
