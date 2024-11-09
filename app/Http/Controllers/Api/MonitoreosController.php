<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Monitoreos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MonitoreosController extends Controller
{
    // Obtener todos los monitoreos
    public function index()
    {
        $monitoreos = Monitoreos::all();
        $data = [
            'monitoreos' => $monitoreos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Obtener un monitoreos por ID
    public function show($id)
    {
        $monitoreos = Monitoreos::find($id);
        if (!$monitoreos) {
            $data = [
                'message' => 'Monitoreo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'monitoreos' => $monitoreos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Crear un nuevo monitoreo
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'required|exists:Usuario,UsuarioID',
            'Tipo_Monitoreo' => 'required|string|max:50',
            'Fecha_Registro' => 'required|date',
            'Notas' => 'nullable|string|max:255',
            'HistorialIMCID' => 'nullable|exists:HistorialIMC,HistorialIMCID',
            'HistorialRitmoCardiacoID' => 'nullable|exists:HistorialRitmoCardiaco,HistorialRitmoCardiacoID',
            'ProgresoID' => 'nullable|exists:Progreso,ProgresoID',
        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $monitoreos = Monitoreos::create($request->all());
        if (!$monitoreos) {
            $data = [
                'message' => 'Error al crear el monitoreo',
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        $data = [
            'monitoreo' => $monitoreos,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    // Actualizar un monitoreo
    public function update(Request $request, $id)
    {
        $monitoreos = Monitoreos::find($id);
        if (!$monitoreos) {
            $data = [
                'message' => 'Monitoreo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'required|exists:Usuario,UsuarioID',
            'Tipo_Monitoreo' => 'required|string|max:50',
            'Fecha_Registro' => 'required|date',
            'Notas' => 'nullable|string|max:255',
            'HistorialIMCID' => 'nullable|exists:HistorialIMC,HistorialIMCID',
            'HistorialRitmoCardiacoID' => 'nullable|exists:HistorialRitmoCardiaco,HistorialRitmoCardiacoID',
            'ProgresoID' => 'nullable|exists:Progreso,ProgresoID',
        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $monitoreos->update($request->all());
        
        $data = [
            'message' => 'Monitoreo actualizado',
            'monitoreo' => $monitoreos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualizar parcialmente un monitoreo
public function updatePartial(Request $request, $id)
{
    $monitoreos = Monitoreos::find($id);
    if (!$monitoreos) {
        $data = [
            'message' => 'Monitoreo no encontrado',
            'status' => 404
        ];
        return response()->json($data, 404);
    }

    $validator = Validator::make($request->all(), [
        'UsuarioID' => 'sometimes|required|exists:Usuario,UsuarioID',
        'Tipo_Monitoreo' => 'sometimes|required|string|max:50',
        'Fecha_Registro' => 'sometimes|required|date',
        'Notas' => 'sometimes|nullable|string|max:255',
        'HistorialIMCID' => 'sometimes|nullable|exists:HistorialIMC,HistorialIMCID',
        'HistorialRitmoCardiacoID' => 'sometimes|nullable|exists:HistorialRitmoCardiaco,HistorialRitmoCardiacoID',
        'ProgresoID' => 'sometimes|nullable|exists:Progreso,ProgresoID',
    ]);

    if ($validator->fails()) {
        $data = [
            'message' => 'Error en la validación de los datos',
            'errors' => $validator->errors(),
            'status' => 400
        ];
        return response()->json($data, 400);
    }

    // Actualizar solo los campos que se proporcionaron
    if ($request->has('UsuarioID')) {
        $monitoreos->UsuarioID = $request->UsuarioID;
    }
    if ($request->has('Tipo_Monitoreo')) {
        $monitoreos->Tipo_Monitoreo = $request->Tipo_Monitoreo;
    }
    if ($request->has('Fecha_Registro')) {
        $monitoreos->Fecha_Registro = $request->Fecha_Registro;
    }
    if ($request->has('Notas')) {
        $monitoreos->Notas = $request->Notas;
    }
    if ($request->has('HistorialIMCID')) {
        $monitoreos->HistorialIMCID = $request->HistorialIMCID;
    }
    if ($request->has('HistorialRitmoCardiacoID')) {
        $monitoreos->HistorialRitmoCardiacoID = $request->HistorialRitmoCardiacoID;
    }
    if ($request->has('ProgresoID')) {
        $monitoreos->ProgresoID = $request->ProgresoID;
    }

    $monitoreos->save();

    $data = [
        'message' => 'Monitoreo actualizado parcialmente',
        'monitoreo' => $monitoreos,
        'status' => 200
    ];
    return response()->json($data, 200);
}

    // Eliminar un monitoreo
    public function destroy($id)
    {
        $monitoreos = Monitoreos::find($id);
        if (!$monitoreos) {
            $data = [
                'message' => 'Monitoreo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $monitoreos->delete();
        $data = [
            'message' => 'Monitoreo eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
