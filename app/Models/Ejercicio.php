<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    use HasFactory;

    protected $table = 'ejercicio';

    protected $fillable = [
        'nombre_ejercicio',
        'categoria',
        'descripcion',
        'tiempo_realizado',
        'calorias_quemadas',
    ];
}
