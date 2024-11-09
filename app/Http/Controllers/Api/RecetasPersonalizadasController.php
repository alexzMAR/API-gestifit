<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RecetasPersonalizada; // Asegúrate de que el modelo RecetasPersonalizada esté creado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecetasPersonalizadasController extends Controller
{
    // Obtener todas las recetas personalizadas
    public function index()
    {
        $recetasPersonalizadas = RecetasPersonalizada::all();
        return response()->json(['recetas_personalizadas' => $recetasPersonalizadas, 'status' => 200], 200);
    }

// Obtener un registro de historial de IMC por ID todos
public function show($firebase_uid)
{
    $recetaPersonalizada = RecetasPersonalizada::where('firebase_uid', $firebase_uid)->get();
    if (!$recetaPersonalizada) {
        return response()->json(['message' => 'recetas_personalizadas no encontrado', 'status' => 404], 404);
    }
    return response()->json(['recetas_personalizadas' => $recetaPersonalizada, 'status' => 200], 200);
}

    // Crear una nueva receta personalizada
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NombreReceta' => 'required|string',
            'recetas_id' => 'required|exists:recetas,id',
            'firebase_uid' => 'required|string', // Asumiendo que hay una tabla Dietas
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Error en la validación de los datos', 'errors' => $validator->errors(), 'status' => 400], 400);
        }

        try {
            $recetaPersonalizada = RecetasPersonalizada::create($request->only(['NombreReceta', 'recetas_id', 'firebase_uid']));
            return response()->json(['recetas_personalizadas' => $recetaPersonalizada, 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el recetaPersonalizada', 'error' => $e->getMessage(), 'status' => 500], 500);
        }
    }

    // Actualizar una receta personalizada
    public function update(Request $request, $id)
    {
        $recetaPersonalizada = RecetasPersonalizada::find($id);
        if (!$recetaPersonalizada) {
            $data = [
                'message' => 'Receta personalizada no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'Fecha_Consumo' => 'date',
            'Cantidad' => 'numeric|min:0',
            'RecetaID' => 'exists:recetas,RecetaID',
            'DietaID' => 'nullable|exists:dietas,DietaID', // Asumiendo que hay una tabla Dietas
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
        if ($request->has('Fecha_Consumo')) {
            $recetaPersonalizada->Fecha_Consumo = $request->Fecha_Consumo;
        }
        if ($request->has('Cantidad')) {
            $recetaPersonalizada->Cantidad = $request->Cantidad;
        }
        if ($request->has('RecetaID')) {
            $recetaPersonalizada->RecetaID = $request->RecetaID;
        }
        if ($request->has('DietaID')) {
            $recetaPersonalizada->DietaID = $request->DietaID;
        }

        $recetaPersonalizada->save();

        $data = [
            'message' => 'Receta personalizada actualizada',
            'receta_personalizada' => $recetaPersonalizada,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualización parcial de una receta personalizada
    public function updatePartial(Request $request, $id)
    {
        $recetaPersonalizada = RecetasPersonalizada::find($id);
        if (!$recetaPersonalizada) {
            $data = [
                'message' => 'Receta personalizada no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'Fecha_Consumo' => 'date',
            'Cantidad' => 'numeric|min:0',
            'RecetaID' => 'exists:recetas,RecetaID',
            'DietaID' => 'nullable|exists:dietas,DietaID', // Asumiendo que hay una tabla Dietas
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
        if ($request->has('Fecha_Consumo')) {
            $recetaPersonalizada->Fecha_Consumo = $request->Fecha_Consumo;
        }
        if ($request->has('Cantidad')) {
            $recetaPersonalizada->Cantidad = $request->Cantidad;
        }
        if ($request->has('RecetaID')) {
            $recetaPersonalizada->RecetaID = $request->RecetaID;
        }
        if ($request->has('DietaID')) {
            $recetaPersonalizada->DietaID = $request->DietaID;
        }

        $recetaPersonalizada->save();

        $data = [
            'message' => 'Receta personalizada actualizada parcialmente',
            'receta_personalizada' => $recetaPersonalizada,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar una receta personalizada
    public function destroy($id)
    {
        $recetaPersonalizada = RecetasPersonalizada::find($id);
        if (!$recetaPersonalizada) {
            $data = [
                'message' => 'Receta personalizada no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $recetaPersonalizada->delete();
        $data = [
            'message' => 'Receta personalizada eliminada',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
