<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cotizacion_tipo_estados extends Model
{
    use HasFactory;

    protected $table = 'ct_cotizacion_tipo_estados';
    protected $primaryKey = 'CT_ID';
    public $timestamps = false;

    protected $fillable = [
        'CT_PLATAFORMA',
        'CT_NOMBRE_ESTADO',
        'CT_ESTADO',
        'CT_DIAS_BLOQUEADOS',
        'CT_FECHA_MODIFICACION'
    ];
}
