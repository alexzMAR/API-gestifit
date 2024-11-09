<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ejercicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EjercicioController extends Controller
{
    // Obtener todos los ejercicios
    public function index()
    {
        $ejercicios = Ejercicio::all();
        $data = [
            'ejercicios' => $ejercicios,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Obtener un ejercicio por ID
    public function show($id)
    {
        $ejercicio = Ejercicio::find($id);
        if (!$ejercicio) {
            $data = [
                'message' => 'Ejercicio no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'ejercicio' => $ejercicio,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Crear un nuevo ejercicio
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NombreEjercicio' => 'required|string|max:255',
            'Categoria' => 'required|in:Cardio,Fuerza,Flexibilidad',
            'Descripción' => 'nullable|string',
            'TiempoRealizado' => 'required|integer|min:0',
            'CaloriasQuemadas' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $ejercicio = Ejercicio::create([
            'NombreEjercicio' => $request->NombreEjercicio,
            'Categoria' => $request->Categoria,
            'Descripción' => $request->Descripción,
            'TiempoRealizado' => $request->TiempoRealizado,
            'CaloriasQuemadas' => $request->CaloriasQuemadas,
        ]);

        $data = [
            'ejercicio' => $ejercicio,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    // Actualizar un ejercicio
    public function update(Request $request, $id)
    {
        $ejercicio = Ejercicio::find($id);
        if (!$ejercicio) {
            $data = [
                'message' => 'Ejercicio no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'NombreEjercicio' => 'required|string|max:255',
            'Categoria' => 'required|in:Cardio,Fuerza,Flexibilidad',
            'Descripción' => 'nullable|string',
            'TiempoRealizado' => 'required|integer|min:0',
            'CaloriasQuemadas' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $ejercicio->update([
            'NombreEjercicio' => $request->NombreEjercicio,
            'Categoria' => $request->Categoria,
            'Descripción' => $request->Descripción,
            'TiempoRealizado' => $request->TiempoRealizado,
            'CaloriasQuemadas' => $request->CaloriasQuemadas,
        ]);

        $data = [
            'message' => 'Ejercicio actualizado',
            'ejercicio' => $ejercicio,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualización parcial de un ejercicio
    public function updatePartial(Request $request, $id)
    {
        $ejercicio = Ejercicio::find($id);
        if (!$ejercicio) {
            $data = [
                'message' => 'Ejercicio no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'NombreEjercicio' => 'string|max:255',
            'Categoria' => 'in:Cardio,Fuerza,Flexibilidad',
            'Descripción' => 'nullable|string',
            'TiempoRealizado' => 'integer|min:0',
            'CaloriasQuemadas' => 'numeric|min:0',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('NombreEjercicio')) {
            $ejercicio->NombreEjercicio = $request->NombreEjercicio;
        }
        if ($request->has('Categoria')) {
            $ejercicio->Categoria = $request->Categoria;
        }
        if ($request->has('Descripción')) {
            $ejercicio->Descripción = $request->Descripción;
        }
        if ($request->has('TiempoRealizado')) {
            $ejercicio->TiempoRealizado = $request->TiempoRealizado;
        }
        if ($request->has('CaloriasQuemadas')) {
            $ejercicio->CaloriasQuemadas = $request->CaloriasQuemadas;
        }

        $ejercicio->save();

        $data = [
            'message' => 'Ejercicio actualizado parcialmente',
            'ejercicio' => $ejercicio,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar un ejercicio
    public function destroy($id)
    {
        $ejercicio = Ejercicio::find($id);
        if (!$ejercicio) {
            $data = [
                'message' => 'Ejercicio no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $ejercicio->delete();
        $data = [
            'message' => 'Ejercicio eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
