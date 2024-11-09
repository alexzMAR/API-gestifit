<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Progreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgresoController extends Controller
{
    // Obtener todos los registros de progreso
    public function index()
    {
        $progresos = Progreso::all();
        $data = [
            'progresos' => $progresos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Obtener un progreso por ID
    public function show($id)
    {
        $progreso = Progreso::find($id);
        if (!$progreso) {
            $data = [
                'message' => 'Progreso no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'progreso' => $progreso,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Crear un nuevo registro de progreso
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Fecha' => 'required|date',
            'Tipo_Resultado' => 'required|string|max:50',
            'Valor' => 'required|numeric',
            'Observaciones' => 'nullable|string',
            'ObjetivoID' => 'required|exists:objetivos,ObjetivoID',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $progreso = Progreso::create([
            'Fecha' => $request->Fecha,
            'Tipo_Resultado' => $request->Tipo_Resultado,
            'Valor' => $request->Valor,
            'Observaciones' => $request->Observaciones,
            'ObjetivoID' => $request->ObjetivoID,
        ]);

        $data = [
            'progreso' => $progreso,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    // Actualizar un registro de progreso
    public function update(Request $request, $id)
    {
        $progreso = Progreso::find($id);
        if (!$progreso) {
            $data = [
                'message' => 'Progreso no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'Fecha' => 'required|date',
            'Tipo_Resultado' => 'required|string|max:50',
            'Valor' => 'required|numeric',
            'Observaciones' => 'nullable|string',
            'ObjetivoID' => 'required|exists:objetivos,ObjetivoID',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $progreso->update([
            'Fecha' => $request->Fecha,
            'Tipo_Resultado' => $request->Tipo_Resultado,
            'Valor' => $request->Valor,
            'Observaciones' => $request->Observaciones,
            'ObjetivoID' => $request->ObjetivoID,
        ]);

        $data = [
            'message' => 'Progreso actualizado',
            'progreso' => $progreso,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualización parcial de un registro de progreso
    public function updatePartial(Request $request, $id)
    {
        $progreso = Progreso::find($id);
        if (!$progreso) {
            $data = [
                'message' => 'Progreso no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'Fecha' => 'date',
            'Tipo_Resultado' => 'string|max:50',
            'Valor' => 'numeric',
            'Observaciones' => 'string|nullable',
            'ObjetivoID' => 'exists:objetivos,ObjetivoID',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('Fecha')) {
            $progreso->Fecha = $request->Fecha;
        }
        if ($request->has('Tipo_Resultado')) {
            $progreso->Tipo_Resultado = $request->Tipo_Resultado;
        }
        if ($request->has('Valor')) {
            $progreso->Valor = $request->Valor;
        }
        if ($request->has('Observaciones')) {
            $progreso->Observaciones = $request->Observaciones;
        }
        if ($request->has('ObjetivoID')) {
            $progreso->ObjetivoID = $request->ObjetivoID;
        }

        $progreso->save();

        $data = [
            'message' => 'Progreso actualizado parcialmente',
            'progreso' => $progreso,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar un registro de progreso
    public function destroy($id)
    {
        $progreso = Progreso::find($id);
        if (!$progreso) {
            $data = [
                'message' => 'Progreso no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $progreso->delete();
        $data = [
            'message' => 'Progreso eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
