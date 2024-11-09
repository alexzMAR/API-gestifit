<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evaluaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EvaluacionesController extends Controller
{
    // Obtener todos los registros de historial de evaluaciones
    public function index()
    {
        $evaluaciones = Evaluaciones::all();
        return response()->json(['evaluaciones' => $evaluaciones, 'status' => 200], 200);
    }

    // Obtener un registro de historial de evaluaciones por ID todos
    public function show($firebase_uid)
    {
        $evaluaciones = Evaluaciones::where('firebase_uid', $firebase_uid)->get();
        if (!$evaluaciones) {
            return response()->json(['message' => 'evaluaciones no encontrado', 'status' => 404], 404);
        }
        return response()->json(['evaluaciones' => $evaluaciones, 'status' => 200], 200);
    }

        // Obtener un registro de historial de IMC por ID ultimo
        public function fin($firebase_uid) 
        {
            $evaluaciones = Evaluaciones::where('firebase_uid', $firebase_uid)
                ->latest() // Ordena por el timestamp más reciente
                ->first(); // Obtiene el primer resultado
        
            if (!$evaluaciones) {
                return response()->json(['message' => 'evaluaciones no encontrado', 'status' => 404], 404);
            }
            
            return response()->json(['evaluaciones' => $evaluaciones, 'status' => 200], 200);
        }


    // Crear un nuevo registro de evaluaciones
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecharegistro' => 'required|date',
            'resultado' => 'required|string',
            'consejo' => 'required|string',
            'horasSueno' => 'required|integer',
            'comidasDiarias' => 'required|integer',
            'ejercicio' => 'required|integer',
            'frecuenciaTabaco' => 'required|integer',
            'frecuenciaAlcohol' => 'required|integer',
            'nivelEstres' => 'required|integer',
            'firebase_uid' => 'required|string' // Validar el UID del usuario
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Error en la validación de los datos', 'errors' => $validator->errors(), 'status' => 400], 400);
        }

        try {
            $evaluaciones = Evaluaciones::create($request->only(['fecharegistro', 'resultado', 'consejo', 'horasSueno', 'comidasDiarias', 'ejercicio', 'frecuenciaTabaco', 'frecuenciaAlcohol', 'nivelEstres', 'firebase_uid']));
            return response()->json(['evaluaciones' => $evaluaciones, 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el evaluaciones', 'error' => $e->getMessage(), 'status' => 500], 500);
        }
    }


    // Actualizar una evaluación
    public function update(Request $request, $id)
    {
        $evaluacion = Evaluaciones::find($id);
        if (!$evaluacion) {
            $data = [
                'message' => 'Evaluación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'required|exists:usuarios,UsuarioID',
            'Preguntas' => 'required|string',
            'Fecha' => 'required|date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $evaluacion->update([
            'UsuarioID' => $request->UsuarioID,
            'Preguntas' => $request->Preguntas,
            'Fecha' => $request->Fecha
        ]);

        $data = [
            'message' => 'Evaluación actualizada',
            'evaluacion' => $evaluacion,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualización parcial de una evaluación
    public function updatePartial(Request $request, $id)
    {
        $evaluacion = Evaluaciones::find($id);
        if (!$evaluacion) {
            $data = [
                'message' => 'Evaluación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'exists:usuarios,UsuarioID',
            'Preguntas' => 'string',
            'Fecha' => 'date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('UsuarioID')) {
            $evaluacion->UsuarioID = $request->UsuarioID;
        }
        if ($request->has('Preguntas')) {
            $evaluacion->Preguntas = $request->Preguntas;
        }
        if ($request->has('Fecha')) {
            $evaluacion->Fecha = $request->Fecha;
        }

        $evaluacion->save();

        $data = [
            'message' => 'Evaluación actualizada',
            'evaluacion' => $evaluacion,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar una evaluación
    public function destroy($id)
    {
        $evaluacion = Evaluaciones::find($id);
        if (!$evaluacion) {
            $data = [
                'message' => 'Evaluación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $evaluacion->delete();
        $data = [
            'message' => 'Evaluación eliminada',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
