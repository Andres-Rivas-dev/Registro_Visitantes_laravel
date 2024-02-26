<?php

namespace App\Helpers;
use App\Models\GeneracionEdad;
use Carbon\Carbon;

class VisitantesHelper
{
    public static function clasificacionEdad($fecha_nac)
    {

        $fecha = Carbon::parse($fecha_nac);

        $rangos = GeneracionEdad::get();
             
        foreach ($rangos as $value) {

            // Verificar si la fecha está dentro del rango actual
            if ($fecha->between(Carbon::parse($value->desde), Carbon::parse($value->hasta))) {
            }

            $generacion = $value->id;
        }

        return $generacion;
    }
}
