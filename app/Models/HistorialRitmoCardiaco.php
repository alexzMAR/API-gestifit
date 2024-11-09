<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialRitmoCardiaco extends Model
{
    use HasFactory;

    protected $table = 'historial_ritmo_cardiaco';

    protected $fillable = [
        'fecharegistro',
        'RitmoCardiaco',
        'firebase_uid'
    ];
}
