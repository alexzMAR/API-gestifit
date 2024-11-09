<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario'; 

    protected $primaryKey = 'firebase_uid'; // Cambia la clave primaria a 'firebase_uid'
    public $incrementing = false; // Indica que la clave primaria no es un entero

    protected $fillable = [
        'firebase_uid',
        'nombre',
        'apellido',
        'edad',
        'altura',
        'peso',
        'genero',
        'foto_perfil',
        'preferencias_accesibilidad',
        'fecha_registro',
    ];
}
