<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objetivos extends Model
{
    use HasFactory;

    protected $table = 'objetivos';

    protected $fillable = [
        'usuario_id',
        'tipo_objetivo',
        'inicio_fecha',
        'fin_fecha',
        'calorias_obj',
        'pasos_obj',
    ];
}
