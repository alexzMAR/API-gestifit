<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistorialIMC; // Asegúrate de que el modelo HistorialIMC esté creado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HistorialIMCController extends Controller
{
    // Obtener todos los registros de historial de IMC
    public function index()
    {
        $historialIMC = HistorialIMC::all();
        return response()->json(['historialIMC' => $historialIMC, 'status' => 200], 200);
    }

    // Obtener un registro de historial de IMC por ID todos
    public function show($firebase_uid)
    {
        $historialIMC = HistorialIMC::where('firebase_uid', $firebase_uid)->get();
        if (!$historialIMC) {
            return response()->json(['message' => 'historialIMC no encontrado', 'status' => 404], 404);
        }
        return response()->json(['historialIMC' => $historialIMC, 'status' => 200], 200);
    }

    // Obtener un registro de historial de IMC por ID ultimo
    public function fin($firebase_uid) 
    {
        $historialIMC = HistorialIMC::where('firebase_uid', $firebase_uid)
            ->latest() // Ordena por el timestamp más reciente
            ->first(); // Obtiene el primer resultado
    
        if (!$historialIMC) {
            return response()->json(['message' => 'historialIMC no encontrado', 'status' => 404], 404);
        }
        
        return response()->json(['historialIMC' => $historialIMC, 'status' => 200], 200);
    }


    // Crear un nuevo registro de historial de IMC
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecharegistro' => 'required|date',
            'imc' => 'required|decimal:0,2',
            'firebase_uid' => 'required|string' // Validar el UID del usuario
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Error en la validación de los datos', 'errors' => $validator->errors(), 'status' => 400], 400);
        }

        try {
            $historialIMC = HistorialIMC::create($request->only(['fecharegistro', 'imc','firebase_uid']));
            return response()->json(['historialIMC' => $historialIMC, 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el historialIMC', 'error' => $e->getMessage(), 'status' => 500], 500);
        }
    }


    // Actualizar un registro de historial de IMC
    public function update(Request $request, $id)
    {
        $historialIMC = HistorialIMC::find($id);
        if (!$historialIMC) {
            $data = [
                'message' => 'Historial de IMC no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'FechaComparación' => 'date',
            'IMC' => 'decimal:0,2' // Asegura que sea un decimal con dos decimales
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
        if ($request->has('FechaComparación')) {
            $historialIMC->FechaComparación = $request->FechaComparación;
        }
        if ($request->has('IMC')) {
            $historialIMC->IMC = $request->IMC;
        }

        $historialIMC->save();

        $data = [
            'message' => 'Historial de IMC actualizado',
            'historialIMC' => $historialIMC,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar un registro de historial de IMC
    public function destroy($id)
    {
        $historialIMC = HistorialIMC::find($id);
        if (!$historialIMC) {
            $data = [
                'message' => 'Historial de IMC no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $historialIMC->delete();
        $data = [
            'message' => 'Historial de IMC eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
