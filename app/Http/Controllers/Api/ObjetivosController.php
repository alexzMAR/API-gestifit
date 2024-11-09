<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Objetivos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObjetivosController extends Controller
{
    // Obtener todos los objetivos
    public function index()
    {
        $objetivos = Objetivos::all();
        $data = [
            'objetivos' => $objetivos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Obtener un objetivo por ID
    public function show($id)
    {
        $objetivo = Objetivos::find($id);
        if (!$objetivo) {
            $data = [
                'message' => 'Objetivo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'objetivo' => $objetivo,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Crear un nuevo objetivo
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'required|exists:usuarios,UsuarioID',
            'TipoObjetivo' => 'required|string|max:50',
            'InicioFecha' => 'required|date',
            'FinFecha' => 'required|date',
            'CaloriasObj' => 'required|integer',
            'PasosObj' => 'required|integer'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $objetivo = Objetivos::create([
            'UsuarioID' => $request->UsuarioID,
            'TipoObjetivo' => $request->TipoObjetivo,
            'InicioFecha' => $request->InicioFecha,
            'FinFecha' => $request->FinFecha,
            'CaloriasObj' => $request->CaloriasObj,
            'PasosObj' => $request->PasosObj
        ]);

        $data = [
            'objetivo' => $objetivo,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    // Actualizar un objetivo
    public function update(Request $request, $id)
    {
        $objetivo = Objetivos::find($id);
        if (!$objetivo) {
            $data = [
                'message' => 'Objetivo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'required|exists:usuarios,UsuarioID',
            'TipoObjetivo' => 'required|string|max:50',
            'InicioFecha' => 'required|date',
            'FinFecha' => 'required|date',
            'CaloriasObj' => 'required|integer',
            'PasosObj' => 'required|integer'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $objetivo->update([
            'UsuarioID' => $request->UsuarioID,
            'TipoObjetivo' => $request->TipoObjetivo,
            'InicioFecha' => $request->InicioFecha,
            'FinFecha' => $request->FinFecha,
            'CaloriasObj' => $request->CaloriasObj,
            'PasosObj' => $request->PasosObj
        ]);

        $data = [
            'message' => 'Objetivo actualizado',
            'objetivo' => $objetivo,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualización parcial del objetivo
    public function updatePartial(Request $request, $id)
    {
        $objetivo = Objetivos::find($id);
        if (!$objetivo) {
            $data = [
                'message' => 'Objetivo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'exists:usuarios,UsuarioID',
            'TipoObjetivo' => 'string|max:50',
            'InicioFecha' => 'date',
            'FinFecha' => 'date',
            'CaloriasObj' => 'integer',
            'PasosObj' => 'integer'
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
            $objetivo->UsuarioID = $request->UsuarioID;
        }
        if ($request->has('TipoObjetivo')) {
            $objetivo->TipoObjetivo = $request->TipoObjetivo;
        }
        if ($request->has('InicioFecha')) {
            $objetivo->InicioFecha = $request->InicioFecha;
        }
        if ($request->has('FinFecha')) {
            $objetivo->FinFecha = $request->FinFecha;
        }
        if ($request->has('CaloriasObj')) {
            $objetivo->CaloriasObj = $request->CaloriasObj;
        }
        if ($request->has('PasosObj')) {
            $objetivo->PasosObj = $request->PasosObj;
        }

        $objetivo->save();

        $data = [
            'message' => 'Objetivo actualizado parcialmente',
            'objetivo' => $objetivo,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar un objetivo
    public function destroy($id)
    {
        $objetivo = Objetivos::find($id);
        if (!$objetivo) {
            $data = [
                'message' => 'Objetivo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $objetivo->delete();
        $data = [
            'message' => 'Objetivo eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
