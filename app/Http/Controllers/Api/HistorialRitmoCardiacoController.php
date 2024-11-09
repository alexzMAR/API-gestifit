<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistorialRitmoCardiaco; // Asegúrate de que el modelo HistorialRitmoCardiaco esté creado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HistorialRitmoCardiacoController extends Controller
{
    // Obtener todos los registros de historial de ritmo cardíaco
    public function index()
    {
        $historialRitmoCardiaco = HistorialRitmoCardiaco::all(); // Obtén todos los registros
        return response()->json(['historialRitmoCardiaco' => $historialRitmoCardiaco, 'status' => 200], 200);
    }

    // Obtener un registro de historial de IMC por ID todos
    public function show($firebase_uid)
    {
        $historialRitmoCardiaco = HistorialRitmoCardiaco::where('firebase_uid', $firebase_uid)->get();
        if (!$historialRitmoCardiaco) {
            return response()->json(['message' => 'Historial de ritmo cardíaco no encontrado', 'status' => 404], 404);
        }
        return response()->json(['Historial RitmoCardiaco' => $historialRitmoCardiaco, 'status' => 200], 200);
    }

    // Obtener un registro de historial de IMC por ID ultimo
    public function fin($firebase_uid) 
    {
        $historialRitmoCardiaco = HistorialRitmoCardiaco::where('firebase_uid', $firebase_uid)
            ->latest() // Ordena por el timestamp más reciente
            ->first(); // Obtiene el primer resultado
    
        if (!$historialRitmoCardiaco) {
            return response()->json(['message' => 'historialRitmoCardiaco no encontrado', 'status' => 404], 404);
        }
        
        return response()->json(['historialRitmoCardiaco' => $historialRitmoCardiaco, 'status' => 200], 200);
    }


    // Crear un nuevo registro de historial de ritmo cardíaco
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecharegistro' => 'required|date',
            'RitmoCardiaco' => 'required|decimal:0,2', // Asegura que sea un decimal con dos decimales
            'firebase_uid' => 'required|string' // Validar el UID del usuario
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Error en la validación de los datos', 'errors' => $validator->errors(), 'status' => 400], 400);
        }

        try {
            $historialRitmoCardiaco = HistorialRitmoCardiaco::create($request->only(['fecharegistro', 'RitmoCardiaco','firebase_uid']));
            return response()->json(['historialRitmoCardiaco' => $historialRitmoCardiaco, 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el historialRitmoCardiaco', 'error' => $e->getMessage(), 'status' => 500], 500);
        }
    }

    // Actualizar un registro de historial de ritmo cardíaco
    public function update(Request $request, $id)
    {
        $historialRitmoCardiaco = HistorialRitmoCardiaco::find($id);
        if (!$historialRitmoCardiaco) {
            $data = [
                'message' => 'Historial de ritmo cardíaco no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'fecharegistro' => 'date',
            'Seguimiento' => 'string',
            'RitmoCardiaco' => 'decimal:0,2' // Asegura que sea un decimal con dos decimales
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
        if ($request->has('fecharegistro')) {
            $historialRitmoCardiaco->fecharegistro = $request->fecharegistro;
        }
        if ($request->has('Seguimiento')) {
            $historialRitmoCardiaco->Seguimiento = $request->Seguimiento;
        }
        if ($request->has('RitmoCardiaco')) {
            $historialRitmoCardiaco->RitmoCardiaco = $request->RitmoCardiaco;
        }

        $historialRitmoCardiaco->save();

        $data = [
            'message' => 'Historial de ritmo cardíaco actualizado',
            'historialRitmoCardiaco' => $historialRitmoCardiaco,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar un registro de historial de ritmo cardíaco
    public function destroy($id)
    {
        $historialRitmoCardiaco = HistorialRitmoCardiaco::find($id);
        if (!$historialRitmoCardiaco) {
            $data = [
                'message' => 'Historial de ritmo cardíaco no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $historialRitmoCardiaco->delete();
        $data = [
            'message' => 'Historial de ritmo cardíaco eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
