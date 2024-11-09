<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escaneo extends Model
{
    use HasFactory;

    protected $table = 'escaneo';

    protected $fillable = [
        'alimento_id',
        'fecha_escaneo',
        'tipo_escaneo',
    ];
}
