<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dieta; // Asegúrate de que el modelo Dieta esté creado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DietaController extends Controller
{
    // Obtener todas las dietas
    public function index()
    {
        $dietas = Dieta::with(['usuario', 'recetasPersonalizadas', 'registroAlimentos'])->get(); // Incluye las relaciones si es necesario
        $data = [
            'dietas' => $dietas,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Obtener una dieta por ID
    public function show($id)
    {
        $dieta = Dieta::with(['usuario', 'recetasPersonalizadas', 'registroAlimentos'])->find($id); // Incluye las relaciones si es necesario
        if (!$dieta) {
            $data = [
                'message' => 'Dieta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'dieta' => $dieta,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Crear una nueva dieta
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'required|integer|exists:Usuario,UsuarioID',
            'FechaConsumo' => 'required|date',
            'Proteinas' => 'required|decimal',
            'Calorias' => 'required|decimal',
            'Grasas' => 'required|decimal',
            'RecetasPersonalizadasID' => 'nullable|integer|exists:RecetasPersonalizadas,RecetaPersonalizadaID',
            'RegistroAlimentosID' => 'nullable|integer|exists:RegistroAlimentos,RegistroAlimentosID',
            'Completado' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $dieta = Dieta::create([
            'UsuarioID' => $request->UsuarioID,
            'FechaConsumo' => $request->FechaConsumo,
            'Proteinas' => $request->Proteinas,
            'Calorias' => $request->Calorias,
            'Grasas' => $request->Grasas,
            'RecetasPersonalizadasID' => $request->RecetasPersonalizadasID,
            'RegistroAlimentosID' => $request->RegistroAlimentosID,
            'Completado' => $request->Completado
        ]);

        $data = [
            'dieta' => $dieta,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    // Actualizar una dieta
    public function update(Request $request, $id)
    {
        $dieta = Dieta::find($id);
        if (!$dieta) {
            $data = [
                'message' => 'Dieta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'integer|exists:Usuario,UsuarioID',
            'FechaConsumo' => 'date',
            'Proteinas' => 'decimal',
            'Calorias' => 'decimal',
            'Grasas' => 'decimal',
            'RecetasPersonalizadasID' => 'nullable|integer|exists:RecetasPersonalizadas,RecetaPersonalizadaID',
            'RegistroAlimentosID' => 'nullable|integer|exists:RegistroAlimentos,RegistroAlimentosID',
            'Completado' => 'boolean'
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
        if ($request->has('UsuarioID')) {
            $dieta->UsuarioID = $request->UsuarioID;
        }
        if ($request->has('FechaConsumo')) {
            $dieta->FechaConsumo = $request->FechaConsumo;
        }
        if ($request->has('Proteinas')) {
            $dieta->Proteinas = $request->Proteinas;
        }
        if ($request->has('Calorias')) {
            $dieta->Calorias = $request->Calorias;
        }
        if ($request->has('Grasas')) {
            $dieta->Grasas = $request->Grasas;
        }
        if ($request->has('RecetasPersonalizadasID')) {
            $dieta->RecetasPersonalizadasID = $request->RecetasPersonalizadasID;
        }
        if ($request->has('RegistroAlimentosID')) {
            $dieta->RegistroAlimentosID = $request->RegistroAlimentosID;
        }
        if ($request->has('Completado')) {
            $dieta->Completado = $request->Completado;
        }

        $dieta->save();

        $data = [
            'message' => 'Dieta actualizada',
            'dieta' => $dieta,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualización parcial de una dieta
    public function updatePartial(Request $request, $id)
    {
        $dieta = Dieta::find($id);
        if (!$dieta) {
            $data = [
                'message' => 'Dieta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'UsuarioID' => 'integer|exists:Usuario,UsuarioID',
            'FechaConsumo' => 'date',
            'Proteinas' => 'decimal',
            'Calorias' => 'decimal',
            'Grasas' => 'decimal',
            'RecetasPersonalizadasID' => 'nullable|integer|exists:RecetasPersonalizadas,RecetaPersonalizadaID',
            'RegistroAlimentosID' => 'nullable|integer|exists:RegistroAlimentos,RegistroAlimentosID',
            'Completado' => 'boolean'
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
        if ($request->has('UsuarioID')) {
            $dieta->UsuarioID = $request->UsuarioID;
        }
        if ($request->has('FechaConsumo')) {
            $dieta->FechaConsumo = $request->FechaConsumo;
        }
        if ($request->has('Proteinas')) {
            $dieta->Proteinas = $request->Proteinas;
        }
        if ($request->has('Calorias')) {
            $dieta->Calorias = $request->Calorias;
        }
        if ($request->has('Grasas')) {
            $dieta->Grasas = $request->Grasas;
        }
        if ($request->has('RecetasPersonalizadasID')) {
            $dieta->RecetasPersonalizadasID = $request->RecetasPersonalizadasID;
        }
        if ($request->has('RegistroAlimentosID')) {
            $dieta->RegistroAlimentosID = $request->RegistroAlimentosID;
        }
        if ($request->has('Completado')) {
            $dieta->Completado = $request->Completado;
        }

        $dieta->save();

        $data = [
            'message' => 'Dieta actualizada parcialmente',
            'dieta' => $dieta,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar una dieta
    public function destroy($id)
    {
        $dieta = Dieta::find($id);
        if (!$dieta) {
            $data = [
                'message' => 'Dieta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $dieta->delete();
        $data = [
            'message' => 'Dieta eliminada',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
