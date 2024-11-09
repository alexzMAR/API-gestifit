<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alimentos; // Asegúrate de que el modelo Alimento esté creado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlimentosController extends Controller
{
    // Obtener todos los alimentos
    public function index()
    {
        $alimentos = Alimentos::all();
        $data = [
            'alimentos' => $alimentos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Obtener un alimento por ID
    public function show($id)
    {
        $alimentos = Alimentos::find($id);
        if (!$alimentos) {
            $data = [
                'message' => 'Alimento no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'alimentos' => $alimentos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Crear un nuevo alimento
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nombre' => 'required|string|max:255',
            'FechaEscaneo' => 'required|date',
            'Información' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $alimentos = Alimentos::create([
            'Nombre' => $request->Nombre,
            'FechaEscaneo' => $request->FechaEscaneo,
            'Información' => $request->Información
        ]);

        $data = [
            'alimento' => $alimentos,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    // Actualizar un alimento
    public function update(Request $request, $id)
    {
        $alimentos = Alimentos::find($id);
        if (!$alimentos) {
            $data = [
                'message' => 'Alimento no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'Nombre' => 'string|max:255',
            'FechaEscaneo' => 'date',
            'Información' => 'nullable|string|max:255'
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
        if ($request->has('Nombre')) {
            $alimentos->Nombre = $request->Nombre;
        }
        if ($request->has('FechaEscaneo')) {
            $alimentos->FechaEscaneo = $request->FechaEscaneo;
        }
        if ($request->has('Información')) {
            $alimentos->Información = $request->Información;
        }

        $alimentos->save();

        $data = [
            'message' => 'Alimento actualizado',
            'alimento' => $alimentos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualización parcial de un alimento
    public function updatePartial(Request $request, $id)
    {
        $alimentos = Alimentos::find($id);
        if (!$alimentos) {
            $data = [
                'message' => 'Alimento no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'Nombre' => 'string|max:255',
            'FechaEscaneo' => 'date',
            'Información' => 'nullable|string|max:255'
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
        if ($request->has('Nombre')) {
            $alimentos->Nombre = $request->Nombre;
        }
        if ($request->has('FechaEscaneo')) {
            $alimentos->FechaEscaneo = $request->FechaEscaneo;
        }
        if ($request->has('Información')) {
            $alimentos->Información = $request->Información;
        }

        $alimentos->save();

        $data = [
            'message' => 'Alimento actualizado parcialmente',
            'alimento' => $alimentos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar un alimento
    public function destroy($id)
    {
        $alimento = Alimentos::find($id);
        if (!$alimento) {
            $data = [
                'message' => 'Alimento no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $alimento->delete();
        $data = [
            'message' => 'Alimento eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
