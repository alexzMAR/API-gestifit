<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dieta extends Model
{
    use HasFactory;

    protected $table = 'dieta';

    protected $fillable = [
        'usuario_id',
        'fecha_consumo',
        'proteinas',
        'calorias',
        'grasas',
        'recetas_personalizadas_id',
        'registro_alimentos_id',
        'completado',
    ];
}
