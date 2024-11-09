<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluaciones extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones';

    protected $fillable = [
            'firebase_uid', 
            'fecharegistro',
            'resultado',
            'consejo',
            'horasSueno',
            'comidasDiarias', 
            'ejercicio',
            'frecuenciaTabaco',
            'frecuenciaAlcohol',
            'nivelEstres'
    ];
}
