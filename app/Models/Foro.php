<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foro extends Model
{
    use HasFactory;

    protected $table = 'foro';

    protected $fillable = [
        'usuario_id',
        'tema',
        'contenido',
        'fecha_publicacion',
        'tipo',
    ];
}
