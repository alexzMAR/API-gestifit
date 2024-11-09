<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroActividad extends Model
{
    use HasFactory;

    protected $table = 'registro_actividad';

    protected $fillable = [
        'usuario_id',
        'fecha',
        'calorias_quemadas',
        'tiempo_realizado',
        'completado',
        'ejercicio_id',
    ];
}
