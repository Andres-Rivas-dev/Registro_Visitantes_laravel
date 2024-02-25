<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneracionEdad extends Model
{
    use HasFactory;

    protected $table = 'ct_generacion_edad';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'desde',
        'hasta'
    ];
}
