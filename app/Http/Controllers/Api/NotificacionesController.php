<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notificaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificacionesController extends Controller
{
    // Obtener todas las notificaciones
    public function index()
    {
        $notificaciones = Notificaciones::all();
        $data = [
            'notificaciones' => $notificaciones,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Obtener una notificación por ID
    public function show($id)
    {
        $notificacion = Notificaciones::find($id);
        if (!$notificacion) {
            $data = [
                'message' => 'Notificación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'notificacion' => $notificacion,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Crear una nueva notificación
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'required|exists:usuario,UsuarioID',
            'Tipo' => 'required|in:Recordatorio Agua,Recordatorio Ejercicio,Progreso',
            'Mensaje' => 'required|string',
            'FechaEnvio' => 'required|date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $notificacion = Notificaciones::create($request->all());

        $data = [
            'notificacion' => $notificacion,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    // Actualizar una notificación
    public function update(Request $request, $id)
    {
        $notificacion = Notificaciones::find($id);
        if (!$notificacion) {
            $data = [
                'message' => 'Notificación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'required|exists:usuario,UsuarioID',
            'Tipo' => 'required|in:Recordatorio Agua,Recordatorio Ejercicio,Progreso',
            'Mensaje' => 'required|string',
            'FechaEnvio' => 'required|date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $notificacion->update($request->all());

        $data = [
            'message' => 'Notificación actualizada',
            'notificacion' => $notificacion,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualización parcial de una notificación
    public function updatePartial(Request $request, $id)
    {
        $notificacion = Notificaciones::find($id);
        if (!$notificacion) {
            $data = [
                'message' => 'Notificación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'exists:usuario,UsuarioID',
            'Tipo' => 'in:Recordatorio Agua,Recordatorio Ejercicio,Progreso',
            'Mensaje' => 'string',
            'FechaEnvio' => 'date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $notificacion->update($request->all());

        $data = [
            'message' => 'Notificación actualizada',
            'notificacion' => $notificacion,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar una notificación
    public function destroy($id)
    {
        $notificacion = Notificaciones::find($id);
        if (!$notificacion) {
            $data = [
                'message' => 'Notificación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $notificacion->delete();
        $data = [
            'message' => 'Notificación eliminada',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
