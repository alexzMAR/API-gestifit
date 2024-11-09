<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RegistroActividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistroActividadController extends Controller
{
    // Obtener todos los registros de actividad
    public function index()
    {
        $registros = RegistroActividad::all();
        $data = [
            'registros' => $registros,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Obtener un registro de actividad por ID
    public function show($id)
    {
        $registro = RegistroActividad::find($id);
        if (!$registro) {
            $data = [
                'message' => 'Registro de actividad no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'registro' => $registro,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Crear un nuevo registro de actividad
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'required|integer|exists:Usuario,UsuarioID',
            'Fecha' => 'required|date',
            'CaloriasQuemadas' => 'required|numeric|min:0',
            'TiempoRealizado' => 'required|integer|min:0',
            'Completado' => 'required|boolean',
            'EjercicioID' => 'required|integer|exists:Ejercicio,EjercicioID',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $registro = RegistroActividad::create([
            'UsuarioID' => $request->UsuarioID,
            'Fecha' => $request->Fecha,
            'CaloriasQuemadas' => $request->CaloriasQuemadas,
            'TiempoRealizado' => $request->TiempoRealizado,
            'Completado' => $request->Completado,
            'EjercicioID' => $request->EjercicioID,
        ]);

        $data = [
            'registro' => $registro,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    // Actualizar un registro de actividad
    public function update(Request $request, $id)
    {
        $registro = RegistroActividad::find($id);
        if (!$registro) {
            $data = [
                'message' => 'Registro de actividad no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'integer|exists:Usuario,UsuarioID',
            'Fecha' => 'date',
            'CaloriasQuemadas' => 'numeric|min:0',
            'TiempoRealizado' => 'integer|min:0',
            'Completado' => 'boolean',
            'EjercicioID' => 'integer|exists:Ejercicio,EjercicioID',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Actualizar solo los campos que se envían en la solicitud
        if ($request->has('UsuarioID')) {
            $registro->UsuarioID = $request->UsuarioID;
        }
        if ($request->has('Fecha')) {
            $registro->Fecha = $request->Fecha;
        }
        if ($request->has('CaloriasQuemadas')) {
            $registro->CaloriasQuemadas = $request->CaloriasQuemadas;
        }
        if ($request->has('TiempoRealizado')) {
            $registro->TiempoRealizado = $request->TiempoRealizado;
        }
        if ($request->has('Completado')) {
            $registro->Completado = $request->Completado;
        }
        if ($request->has('EjercicioID')) {
            $registro->EjercicioID = $request->EjercicioID;
        }

        $registro->save();

        $data = [
            'message' => 'Registro de actividad actualizado',
            'registro' => $registro,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualización parcial de un registro de actividad
    public function updatePartial(Request $request, $id)
    {
        $registro = RegistroActividad::find($id);
        if (!$registro) {
            $data = [
                'message' => 'Registro de actividad no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'integer|exists:Usuario,UsuarioID',
            'Fecha' => 'date',
            'CaloriasQuemadas' => 'numeric|min:0',
            'TiempoRealizado' => 'integer|min:0',
            'Completado' => 'boolean',
            'EjercicioID' => 'integer|exists:Ejercicio,EjercicioID',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Actualizar solo los campos que se envían en la solicitud
        if ($request->has('UsuarioID')) {
            $registro->UsuarioID = $request->UsuarioID;
        }
        if ($request->has('Fecha')) {
            $registro->Fecha = $request->Fecha;
        }
        if ($request->has('CaloriasQuemadas')) {
            $registro->CaloriasQuemadas = $request->CaloriasQuemadas;
        }
        if ($request->has('TiempoRealizado')) {
            $registro->TiempoRealizado = $request->TiempoRealizado;
        }
        if ($request->has('Completado')) {
            $registro->Completado = $request->Completado;
        }
        if ($request->has('EjercicioID')) {
            $registro->EjercicioID = $request->EjercicioID;
        }

        $registro->save();

        $data = [
            'message' => 'Registro de actividad actualizado parcialmente',
            'registro' => $registro,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar un registro de actividad
    public function destroy($id)
    {
        $registro = RegistroActividad::find($id);
        if (!$registro) {
            $data = [
                'message' => 'Registro de actividad no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $registro->delete();
        $data = [
            'message' => 'Registro de actividad eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
