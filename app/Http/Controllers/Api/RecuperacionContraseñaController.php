<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RecuperacionContraseña;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecuperacionContraseñaController extends Controller
{
    // Obtener todas las solicitudes de recuperación de contraseña
    public function index()
    {
        $recuperaciones = RecuperacionContraseña::all();
        $data = [
            'recuperaciones' => $recuperaciones,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Obtener una solicitud de recuperación de contraseña por ID
    public function show($id)
    {
        $recuperacion = RecuperacionContraseña::find($id);
        if (!$recuperacion) {
            $data = [
                'message' => 'Recuperación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'recuperacion' => $recuperacion,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Crear una nueva solicitud de recuperación de contraseña
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Correo' => 'required|email|max:100',
            'Token' => 'required|string|max:255',
            'FechaExpiración' => 'required|date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $recuperacion = RecuperacionContraseña::create($request->all());

        $data = [
            'recuperacion' => $recuperacion,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    // Actualizar una solicitud de recuperación de contraseña
    public function update(Request $request, $id)
    {
        $recuperacion = RecuperacionContraseña::find($id);
        if (!$recuperacion) {
            $data = [
                'message' => 'Recuperación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'Correo' => 'required|email|max:100',
            'Token' => 'required|string|max:255',
            'FechaExpiración' => 'required|date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $recuperacion->update($request->all());

        $data = [
            'message' => 'Recuperación actualizada',
            'recuperacion' => $recuperacion,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualización parcial de una solicitud de recuperación de contraseña
    public function updatePartial(Request $request, $id)
    {
        $recuperacion = RecuperacionContraseña::find($id);
        if (!$recuperacion) {
            $data = [
                'message' => 'Recuperación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'Correo' => 'email|max:100',
            'Token' => 'string|max:255',
            'FechaExpiración' => 'date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $recuperacion->update($request->all());

        $data = [
            'message' => 'Recuperación actualizada',
            'recuperacion' => $recuperacion,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar una solicitud de recuperación de contraseña
    public function destroy($id)
    {
        $recuperacion = RecuperacionContraseña::find($id);
        if (!$recuperacion) {
            $data = [
                'message' => 'Recuperación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $recuperacion->delete();
        $data = [
            'message' => 'Recuperación eliminada',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
