<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Amigos; // Asegúrate de que el modelo Amigos esté creado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AmigosController extends Controller
{
    // Obtener todos los amigos de un usuario
    public function index()
    {
        $amigos = Amigos::all(); // Carga la relación amigo si es necesario
        $data = [
            'amigos' => $amigos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Obtener un amigo por ID
    public function show($id)
    {
        $amigo = Amigos::with('amigo')->find($id);
        if (!$amigo) {
            $data = [
                'message' => 'Amigo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'amigo' => $amigo,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Crear un nuevo amigo
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'required|exists:Usuario,UsuarioID',
            'AmigoID' => 'required|exists:Usuario,UsuarioID',
            'Estado' => 'required|string|max:50',
            'Nivel_Amistad' => 'required|integer',
            'Notas' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $amigo = Amigos::create([
            'UsuarioID' => $request->UsuarioID,
            'AmigoID' => $request->AmigoID,
            'Estado' => $request->Estado,
            'Nivel_Amistad' => $request->Nivel_Amistad,
            'Notas' => $request->Notas,
        ]);

        $data = [
            'amigo' => $amigo,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    // Actualizar un amigo
    public function update(Request $request, $id)
    {
        $amigo = Amigos::find($id);
        if (!$amigo) {
            $data = [
                'message' => 'Amigo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'Estado' => 'nullable|string|max:50',
            'Nivel_Amistad' => 'nullable|integer',
            'Notas' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Actualiza solo los campos que se envían en la solicitud
        if ($request->has('Estado')) {
            $amigo->Estado = $request->Estado;
        }
        if ($request->has('Nivel_Amistad')) {
            $amigo->Nivel_Amistad = $request->Nivel_Amistad;
        }
        if ($request->has('Notas')) {
            $amigo->Notas = $request->Notas;
        }

        $amigo->save();

        $data = [
            'message' => 'Amigo actualizado',
            'amigo' => $amigo,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualización parcial de un amigo
    public function updatePartial(Request $request, $id)
    {
        $amigo = Amigos::find($id);
        if (!$amigo) {
            $data = [
                'message' => 'Amigo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Validaciones solo para campos que se pueden actualizar
        $validator = Validator::make($request->all(), [
            'Estado' => 'nullable|string|max:50',
            'Nivel_Amistad' => 'nullable|integer',
            'Notas' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Actualiza solo los campos que se envían en la solicitud
        if ($request->has('Estado')) {
            $amigo->Estado = $request->Estado;
        }
        if ($request->has('Nivel_Amistad')) {
            $amigo->Nivel_Amistad = $request->Nivel_Amistad;
        }
        if ($request->has('Notas')) {
            $amigo->Notas = $request->Notas;
        }

        $amigo->save();

        $data = [
            'message' => 'Amigo actualizado parcialmente',
            'amigo' => $amigo,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar un amigo
    public function destroy($id)
    {
        $amigo = Amigos::find($id);
        if (!$amigo) {
            $data = [
                'message' => 'Amigo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $amigo->delete();
        $data = [
            'message' => 'Amigo eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
