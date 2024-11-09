<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroAlimentos extends Model
{
    use HasFactory;

    protected $table = 'registro_alimentos';

    protected $fillable = [
        'escaneo_id',
        'alimento_id',
        'fecha_consumo',
        'cantidad',
    ];
}
