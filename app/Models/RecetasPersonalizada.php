<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecetasPersonalizada extends Model
{
    use HasFactory;

    protected $table = 'recetas_personalizadas';

    protected $fillable = [
        'NombreReceta',
        'recetas_id',
        'firebase_uid',
    ];
}
