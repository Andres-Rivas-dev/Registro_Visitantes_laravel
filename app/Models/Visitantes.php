<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitantes extends Model
{
    use HasFactory;

    protected $table = 'ds_visitantes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'dui',
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'email',
        'telefono'
    ];

    public function generacion()
    {
        return $this->hasOne(GeneracionEdad::class, 'id', 'id_generacion');
    }
}
