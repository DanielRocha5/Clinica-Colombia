<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'tipo_id',
        'numero_id',
        'cargo',
        'email',
        'telefono',
    ];
}