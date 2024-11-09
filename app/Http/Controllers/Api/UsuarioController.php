<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    // Obtener todos los usuarios
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json(['usuarios' => $usuarios, 'status' => 200], 200);
    }

    // Obtener un usuario por UID
    public function show($firebase_uid)
    {
        $usuario = Usuario::where('firebase_uid', $firebase_uid)->first();
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado', 'status' => 404], 404);
        }
        return response()->json(['usuario' => $usuario, 'status' => 200], 200);
    }



    // Crear un nuevo usuario
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'edad' => 'required|integer',
            'altura' => 'nullable|numeric|between:0,999.99',
            'peso' => 'nullable|numeric|between:0,999.99',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'foto_perfil' => 'nullable|string|max:255',
            'preferencias_accesibilidad' => 'nullable|in:Normal,Daltonismo,Modo Oscuro',
            'firebase_uid' => 'required|string|max:255|unique:usuario,firebase_uid' // Validación para firebase_uid
        ]); 

        if ($validator->fails()) {
            return response()->json(['message' => 'Error en la validación de los datos', 'errors' => $validator->errors(), 'status' => 400], 400);
        }

        try {
            $usuario = Usuario::create($request->only(['nombre', 'apellido', 'edad', 'altura', 'peso', 'foto_perfil', 'preferencias_accesibilidad', 'firebase_uid']));
            return response()->json(['usuario' => $usuario, 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el usuario', 'error' => $e->getMessage(), 'status' => 500], 500);
        }
    }

    // Actualizar un usuario
    public function update(Request $request, $firebase_uid)
    {
        $usuario = Usuario::where('firebase_uid', $firebase_uid)->first();
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado', 'status' => 404], 404);
        }
    
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'edad' => 'required|integer',
            'altura' => 'nullable|numeric|between:0,999.99',
            'peso' => 'nullable|numeric|between:0,999.99',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'foto_perfil' => 'nullable|string|max:255',
            'preferencias_accesibilidad' => 'nullable|in:Normal,Daltonismo,Modo Oscuro',
            'fecha_registro' => 'nullable|date'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => 'Error en la validación de los datos', 'errors' => $validator->errors(), 'status' => 400], 400);
        }
    
        try {
            $usuario->update($request->only(['nombre', 'apellido', 'edad', 'altura', 'peso', 'genero', 'foto_perfil', 'preferencias_accesibilidad', 'fecha_registro']));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el usuario', 'error' => $e->getMessage(), 'status' => 500], 500);
        }
    
        return response()->json(['message' => 'Usuario actualizado', 'usuario' => $usuario, 'status' => 200], 200);
    }


    // Actualización parcial de un usuario
    public function updatePartial(Request $request, $firebase_uid)
    {
        $usuario = Usuario::find($firebase_uid);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado', 'status' => 404], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'string|max:100',
            'apellido' => 'string|max:100',
            'edad' => 'integer',
            'altura' => 'nullable|numeric|between:0,999.99',
            'peso' => 'nullable|numeric|between:0,999.99',
            'genero' => 'in:Masculino,Femenino,Otro',
            'foto_perfil' => 'nullable|string|max:255',
            'preferencias_accesibilidad' => 'in:Normal,Daltonismo,Modo Oscuro',
            'fecha_registro' => 'nullable|date',
            'firebase_uid' => 'string|max:255' // Permitir actualización de firebase_uid opcionalmente
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Error en la validación de los datos', 'errors' => $validator->errors(), 'status' => 400], 400);
        }

        $usuario->update($request->only(['nombre', 'apellido', 'edad', 'altura', 'peso', 'genero', 'foto_perfil', 'preferencias_accesibilidad', 'fecha_registro', 'firebase_uid']));

        return response()->json(['message' => 'Usuario actualizado', 'usuario' => $usuario, 'status' => 200], 200);
    }

    // Eliminar un usuario
    public function destroy($firebase_uid)
    {
        $usuario = Usuario::find($firebase_uid);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado', 'status' => 404], 404);
        }

        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado', 'status' => 200], 200);
    }
}
