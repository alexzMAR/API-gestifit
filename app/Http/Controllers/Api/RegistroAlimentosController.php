<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RegistroAlimentos; // Asegúrate de que el modelo RegistroAlimentos esté creado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistroAlimentosController extends Controller
{
    // Obtener todos los registros de alimentos
    public function index()
    {
        $registros = RegistroAlimentos::with(['escaneo', 'alimento'])->get(); // Incluye las relaciones si es necesario
        $data = [
            'registros' => $registros,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Obtener un registro de alimento por ID
    public function show($id)
    {
        $registro = RegistroAlimentos::with(['escaneo', 'alimento'])->find($id); // Incluye las relaciones si es necesario
        if (!$registro) {
            $data = [
                'message' => 'Registro de alimento no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'registro' => $registro,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Crear un nuevo registro de alimento
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'EscaneoID' => 'required|integer|exists:escaneo,EscaneoID',
            'AlimentoID' => 'required|integer|exists:alimentos,AlimentoID',
            'FechaConsumo' => 'required|date',
            'Cantidad' => 'required|decimal'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $registro = RegistroAlimentos::create([
            'EscaneoID' => $request->EscaneoID,
            'AlimentoID' => $request->AlimentoID,
            'FechaConsumo' => $request->FechaConsumo,
            'Cantidad' => $request->Cantidad
        ]);

        $data = [
            'registro' => $registro,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    // Actualizar un registro de alimento
    public function update(Request $request, $id)
    {
        $registro = RegistroAlimentos::find($id);
        if (!$registro) {
            $data = [
                'message' => 'Registro de alimento no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'EscaneoID' => 'integer|exists:escaneo,EscaneoID',
            'AlimentoID' => 'integer|exists:alimentos,AlimentoID',
            'FechaConsumo' => 'date',
            'Cantidad' => 'decimal'
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
        if ($request->has('EscaneoID')) {
            $registro->EscaneoID = $request->EscaneoID;
        }
        if ($request->has('AlimentoID')) {
            $registro->AlimentoID = $request->AlimentoID;
        }
        if ($request->has('FechaConsumo')) {
            $registro->FechaConsumo = $request->FechaConsumo;
        }
        if ($request->has('Cantidad')) {
            $registro->Cantidad = $request->Cantidad;
        }

        $registro->save();

        $data = [
            'message' => 'Registro de alimento actualizado',
            'registro' => $registro,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualización parcial de un registro de alimento
    public function updatePartial(Request $request, $id)
    {
        $registro = RegistroAlimentos::find($id);
        if (!$registro) {
            $data = [
                'message' => 'Registro de alimento no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'EscaneoID' => 'integer|exists:escaneo,EscaneoID',
            'AlimentoID' => 'integer|exists:alimentos,AlimentoID',
            'FechaConsumo' => 'date',
            'Cantidad' => 'decimal'
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
        if ($request->has('EscaneoID')) {
            $registro->EscaneoID = $request->EscaneoID;
        }
        if ($request->has('AlimentoID')) {
            $registro->AlimentoID = $request->AlimentoID;
        }
        if ($request->has('FechaConsumo')) {
            $registro->FechaConsumo = $request->FechaConsumo;
        }
        if ($request->has('Cantidad')) {
            $registro->Cantidad = $request->Cantidad;
        }

        $registro->save();

        $data = [
            'message' => 'Registro de alimento actualizado parcialmente',
            'registro' => $registro,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar un registro de alimento
    public function destroy($id)
    {
        $registro = RegistroAlimentos::find($id);
        if (!$registro) {
            $data = [
                'message' => 'Registro de alimento no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $registro->delete();
        $data = [
            'message' => 'Registro de alimento eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
