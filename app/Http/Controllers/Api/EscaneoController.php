<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Escaneo; // Asegúrate de que el modelo Escaneo esté creado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EscaneoController extends Controller
{
    // Obtener todos los escaneos
    public function index()
    {
        $escaneos = Escaneo::all();
        $data = [
            'escaneos' => $escaneos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Obtener un escaneo por ID
    public function show($id)
    {
        $escaneo = Escaneo::find($id);
        if (!$escaneo) {
            $data = [
                'message' => 'Escaneo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'escaneo' => $escaneo,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Crear un nuevo escaneo
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'AlimentoID' => 'required|integer|exists:alimentos,AlimentoID',
            'FechaEscaneo' => 'required|date',
            'TipoEscaneo' => 'required|in:CódigoBarras'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $escaneo = Escaneo::create([
            'AlimentoID' => $request->AlimentoID,
            'FechaEscaneo' => $request->FechaEscaneo,
            'TipoEscaneo' => $request->TipoEscaneo
        ]);

        $data = [
            'escaneo' => $escaneo,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    // Actualizar un escaneo
    public function update(Request $request, $id)
    {
        $escaneo = Escaneo::find($id);
        if (!$escaneo) {
            $data = [
                'message' => 'Escaneo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'AlimentoID' => 'integer|exists:alimentos,AlimentoID',
            'FechaEscaneo' => 'date',
            'TipoEscaneo' => 'in:CódigoBarras'
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
        if ($request->has('AlimentoID')) {
            $escaneo->AlimentoID = $request->AlimentoID;
        }
        if ($request->has('FechaEscaneo')) {
            $escaneo->FechaEscaneo = $request->FechaEscaneo;
        }
        if ($request->has('TipoEscaneo')) {
            $escaneo->TipoEscaneo = $request->TipoEscaneo;
        }

        $escaneo->save();

        $data = [
            'message' => 'Escaneo actualizado',
            'escaneo' => $escaneo,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualización parcial de un escaneo
    public function updatePartial(Request $request, $id)
    {
        $escaneo = Escaneo::find($id);
        if (!$escaneo) {
            $data = [
                'message' => 'Escaneo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'AlimentoID' => 'integer|exists:alimentos,AlimentoID',
            'FechaEscaneo' => 'date',
            'TipoEscaneo' => 'in:CódigoBarras'
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
        if ($request->has('AlimentoID')) {
            $escaneo->AlimentoID = $request->AlimentoID;
        }
        if ($request->has('FechaEscaneo')) {
            $escaneo->FechaEscaneo = $request->FechaEscaneo;
        }
        if ($request->has('TipoEscaneo')) {
            $escaneo->TipoEscaneo = $request->TipoEscaneo;
        }

        $escaneo->save();

        $data = [
            'message' => 'Escaneo actualizado parcialmente',
            'escaneo' => $escaneo,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar un escaneo
    public function destroy($id)
    {
        $escaneo = Escaneo::find($id);
        if (!$escaneo) {
            $data = [
                'message' => 'Escaneo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $escaneo->delete();
        $data = [
            'message' => 'Escaneo eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
