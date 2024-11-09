<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecuperacionContraseña extends Model
{
    use HasFactory;

    protected $table = 'recuperacion_contraseña';

    protected $fillable = [
        'correo',
        'token',
        'fecha_expiracion',
    ];
}
