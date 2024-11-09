<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recetas extends Model
{
    use HasFactory;

    protected $table = 'recetas';

    protected $fillable = [
        'Nombre',
        'Ingredientes',
        'Instrucciones',
        'Tiempo_Preparación',
        'Tiempo_Cocción',
        'Dificultad',
        'Porciones',
        'Fecha_Creación',
        'Categoría',
        'Calorías',
    ];
}
