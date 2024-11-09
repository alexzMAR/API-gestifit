<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amigos extends Model
{
    use HasFactory;

    protected $table = 'amigos';

    protected $fillable = [
        'usuario_id',
        'amigo_id',
        'fecha',
    ];
}
