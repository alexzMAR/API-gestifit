<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recetas; // Asegúrate de que el modelo Receta esté creado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecetasController extends Controller
{
    // Obtener todas las recetas
    public function index()
    {
        $recetas = Recetas::all();
        return response()->json(['recetas' => $recetas, 'status' => 200], 200);
    }

    // Obtener una receta por ID
    public function show($id)
    {
        $recetas = Recetas::find($id);
        if (!$recetas) {
            $data = [
                'message' => 'Receta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'receta' => $recetas,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Crear una nueva receta
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nombre' => 'required|string|max:255',
            'Ingredientes' => 'required|string',
            'Instrucciones' => 'required|string',
            'Tiempo_Preparación' => 'required|integer|min:0',
            'Tiempo_Cocción' => 'required|integer|min:0',
            'Dificultad' => 'required|string|max:50',
            'Porciones' => 'required|integer|min:1',
            'Fecha_Creación' => 'required|date',
            'Categoría' => 'required|string|max:50',
            'Calorías' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Error en la validación de los datos', 'errors' => $validator->errors(), 'status' => 400], 400);
        }

        try {
            $receta = Recetas::create($request->only(['Nombre', 'Ingredientes', 'Instrucciones', 'Tiempo_Preparación', 'Tiempo_Cocción', 'Dificultad', 'Porciones','Fecha_Creación','Categoría','Calorías']));
            return response()->json(['receta' => $receta, 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el receta', 'error' => $e->getMessage(), 'status' => 500], 500);
        }
    }

    // Actualizar una receta
    public function update(Request $request, $id)
    {
        $receta = Recetas::find($id);
        if (!$receta) {
            $data = [
                'message' => 'Receta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'Nombre' => 'string|max:255',
            'Descripción' => 'string',
            'Ingredientes' => 'string',
            'Instrucciones' => 'string',
            'Tiempo_Preparación' => 'integer|min:0',
            'Tiempo_Cocción' => 'integer|min:0',
            'Dificultad' => 'string|max:50',
            'Porciones' => 'integer|min:1',
            'Fecha_Creación' => 'date',
            'Categoría' => 'string|max:50',
            'Calorías' => 'integer|min:0',
            'Tipo' => 'in:Dieta,Ejercicio',
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
            $receta->Nombre = $request->Nombre;
        }
        if ($request->has('Descripción')) {
            $receta->Descripción = $request->Descripción;
        }
        if ($request->has('Ingredientes')) {
            $receta->Ingredientes = $request->Ingredientes;
        }
        if ($request->has('Instrucciones')) {
            $receta->Instrucciones = $request->Instrucciones;
        }
        if ($request->has('Tiempo_Preparación')) {
            $receta->Tiempo_Preparación = $request->Tiempo_Preparación;
        }
        if ($request->has('Tiempo_Cocción')) {
            $receta->Tiempo_Cocción = $request->Tiempo_Cocción;
        }
        if ($request->has('Dificultad')) {
            $receta->Dificultad = $request->Dificultad;
        }
        if ($request->has('Porciones')) {
            $receta->Porciones = $request->Porciones;
        }
        if ($request->has('Fecha_Creación')) {
            $receta->Fecha_Creación = $request->Fecha_Creación;
        }
        if ($request->has('Categoría')) {
            $receta->Categoría = $request->Categoría;
        }
        if ($request->has('Calorías')) {
            $receta->Calorias = $request->Calorias;
        }
        if ($request->has('Tipo')) {
            $receta->Tipo = $request->Tipo;
        }

        $receta->save();

        $data = [
            'message' => 'Receta actualizada',
            'receta' => $receta,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualización parcial de una receta
    public function updatePartial(Request $request, $id)
    {
        $receta = Recetas::find($id);
        if (!$receta) {
            $data = [
                'message' => 'Receta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'Nombre' => 'string|max:255',
            'Descripción' => 'string',
            'Ingredientes' => 'string',
            'Instrucciones' => 'string',
            'Tiempo_Preparación' => 'integer|min:0',
            'Tiempo_Cocción' => 'integer|min:0',
            'Dificultad' => 'string|max:50',
            'Porciones' => 'integer|min:1',
            'Fecha_Creación' => 'date',
            'Categoría' => 'string|max:50',
            'Calorías' => 'integer|min:0'
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
            $receta->Nombre = $request->Nombre;
        }
        if ($request->has('Descripción')) {
            $receta->Descripción = $request->Descripción;
        }
        if ($request->has('Ingredientes')) {
            $receta->Ingredientes = $request->Ingredientes;
        }
        if ($request->has('Instrucciones')) {
            $receta->Instrucciones = $request->Instrucciones;
        }
        if ($request->has('Tiempo_Preparación')) {
            $receta->Tiempo_Preparación = $request->Tiempo_Preparación;
        }
        if ($request->has('Tiempo_Cocción')) {
            $receta->Tiempo_Cocción = $request->Tiempo_Cocción;
        }
        if ($request->has('Dificultad')) {
            $receta->Dificultad = $request->Dificultad;
        }
        if ($request->has('Porciones')) {
            $receta->Porciones = $request->Porciones;
        }
        if ($request->has('Fecha_Creación')) {
            $receta->Fecha_Creación = $request->Fecha_Creación;
        }
        if ($request->has('Categoría')) {
            $receta->Categoría = $request->Categoría;
        }
        if ($request->has('Calorias')) {
            $receta->Calorias = $request->Calorias;
        }
        if ($request->has('Tipo')) {
            $receta->Tipo = $request->Tipo;
        }

        $receta->save();

        $data = [
            'message' => 'Receta actualizada parcialmente',
            'receta' => $receta,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar una receta
    public function destroy($id)
    {
        $receta = Recetas::find($id);
        if (!$receta) {
            $data = [
                'message' => 'Receta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $receta->delete();
        $data = [
            'message' => 'Receta eliminada',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
