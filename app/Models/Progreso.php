<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progreso extends Model
{
    use HasFactory;

    protected $table = 'progreso';

    protected $fillable = [
        'fecha',
        'tipo_resultado',
        'valor',
        'observaciones',
        'objetivo_id',
    ];
}
