<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitantes;
use App\Models\GeneracionEdad;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class VisitantesController extends Controller
{
    public function index()
    {
        $get = Visitantes::get();
        return $get;
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
            'fecha_nacimiento'     => 'required|date',
            'telefono'             => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
        

        $vis = new Visitantes();
        $vis->dui = $request->dui;
        $vis->nombres = $request->nombres;
        $vis->apellidos = $request->apellidos;
        $vis->fecha_nacimiento = $request->fecha_nacimiento;
        $vis->telefono = $request->telefono;
        $vis->save();

        self::clasificacionEdad($vis);       

        return $vis;
    }

    public static function clasificacionEdad($vis){

        $fecha = Carbon::parse($vis->fecha_nacimiento);

        $rangos = GeneracionEdad::get();
             
        foreach ($rangos as $value) {

            // Verificar si la fecha está dentro del rango actual
            if ($fecha->between(Carbon::parse($value->desde), Carbon::parse($value->hasta))) {

                //Se guarda la llave foranea del catalogo en el registro
                $vis->id_generacion = $value->id;
                $vis->save();
            }
        }
    }


   
}
