<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoreos extends Model
{
    use HasFactory;

    protected $table = 'monitoreos';

    protected $fillable = [
        'usuario_id',
        'tipo_monitoreo',
        'valor',
        'fecha',
    ];
}
