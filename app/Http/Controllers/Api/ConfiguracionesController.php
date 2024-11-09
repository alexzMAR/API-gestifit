<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Configuraciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConfiguracionesController extends Controller
{
    // Obtener todas las configuraciones
    public function index()
    {
        $configuraciones = Configuraciones::all();
        $data = [
            'configuraciones' => $configuraciones,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Obtener una configuración por ID
    public function show($id)
    {
        $configuracion = Configuraciones::find($id);
        if (!$configuracion) {
            $data = [
                'message' => 'Configuración no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'configuracion' => $configuracion,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Crear una nueva configuración
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Clave' => 'required|string|max:50',
            'Descripción' => 'required|string|max:255',
            'DescripciónCorta' => 'required|string|max:255',
            'Field_Modificación' => 'required|string|max:255',
            'Campo' => 'required|string|max:50',
            'NotificacionID' => 'required|exists:notificaciones,NotificacionID'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $configuracion = Configuraciones::create($request->all());

        $data = [
            'configuracion' => $configuracion,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    // Actualizar una configuración
    public function update(Request $request, $id)
    {
        $configuracion = Configuraciones::find($id);
        if (!$configuracion) {
            $data = [
                'message' => 'Configuración no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'Clave' => 'required|string|max:50',
            'Descripción' => 'required|string|max:255',
            'DescripciónCorta' => 'required|string|max:255',
            'Field_Modificación' => 'required|string|max:255',
            'Campo' => 'required|string|max:50',
            'NotificacionID' => 'required|exists:notificaciones,NotificacionID'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $configuracion->update($request->all());

        $data = [
            'message' => 'Configuración actualizada',
            'configuracion' => $configuracion,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualización parcial de una configuración
    public function updatePartial(Request $request, $id)
    {
        $configuracion = Configuraciones::find($id);
        if (!$configuracion) {
            $data = [
                'message' => 'Configuración no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'Clave' => 'string|max:50',
            'Descripción' => 'string|max:255',
            'DescripciónCorta' => 'string|max:255',
            'Field_Modificación' => 'string|max:255',
            'Campo' => 'string|max:50',
            'NotificacionID' => 'exists:notificaciones,NotificacionID'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $configuracion->update($request->all());

        $data = [
            'message' => 'Configuración actualizada',
            'configuracion' => $configuracion,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar una configuración
    public function destroy($id)
    {
        $configuracion = Configuraciones::find($id);
        if (!$configuracion) {
            $data = [
                'message' => 'Configuración no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $configuracion->delete();
        $data = [
            'message' => 'Configuración eliminada',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
