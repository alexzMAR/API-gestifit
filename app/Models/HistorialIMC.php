<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialIMC extends Model
{
    use HasFactory;

    protected $table = 'historial_imc';

    protected $fillable = [
        'fecharegistro',
        'imc',
        'firebase_uid'
    ];
}

