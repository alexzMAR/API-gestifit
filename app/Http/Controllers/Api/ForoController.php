<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Foro; // Asegúrate de que el modelo Foro esté creado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ForoController extends Controller
{
    // Obtener todos los foros
    public function index()
    {
        $foros = Foro::all(); // Carga la relación si es necesario
        $data = [
            'foros' => $foros,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Obtener un foro por ID
    public function show($id)
    {
        $foro = Foro::find($id);
        if (!$foro) {
            $data = [
                'message' => 'Foro no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'foro' => $foro,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Crear un nuevo foro
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Contenido' => 'required|string',
            'Fecha_Publicación' => 'required|date',
            'AmigosID' => 'required|exists:Amigos,AmigosID',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $foro = Foro::create([
            'Contenido' => $request->Contenido,
            'Fecha_Publicación' => $request->Fecha_Publicación,
            'AmigosID' => $request->AmigosID,
        ]);

        $data = [
            'foro' => $foro,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    // Actualizar un foro
    public function update(Request $request, $id)
    {
        $foro = Foro::find($id);
        if (!$foro) {
            $data = [
                'message' => 'Foro no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'Contenido' => 'nullable|string',
            'Fecha_Publicación' => 'nullable|date',
            'AmigosID' => 'nullable|exists:Amigos,AmigosID',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Actualiza solo los campos que se envían en la solicitud
        if ($request->has('Contenido')) {
            $foro->Contenido = $request->Contenido;
        }
        if ($request->has('Fecha_Publicación')) {
            $foro->Fecha_Publicación = $request->Fecha_Publicación;
        }
        if ($request->has('AmigosID')) {
            $foro->AmigosID = $request->AmigosID;
        }

        $foro->save();

        $data = [
            'message' => 'Foro actualizado',
            'foro' => $foro,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Actualización parcial de un foro
    public function updatePartial(Request $request, $id)
    {
        $foro = Foro::find($id);
        if (!$foro) {
            $data = [
                'message' => 'Foro no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'Contenido' => 'nullable|string',
            'Fecha_Publicación' => 'nullable|date',
            'AmigosID' => 'nullable|exists:Amigos,AmigosID',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Actualiza solo los campos que se envían en la solicitud
        if ($request->has('Contenido')) {
            $foro->Contenido = $request->Contenido;
        }
        if ($request->has('Fecha_Publicación')) {
            $foro->Fecha_Publicación = $request->Fecha_Publicación;
        }
        if ($request->has('AmigosID')) {
            $foro->AmigosID = $request->AmigosID;
        }

        $foro->save();

        $data = [
            'message' => 'Foro actualizado parcialmente',
            'foro' => $foro,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Eliminar un foro
    public function destroy($id)
    {
        $foro = Foro::find($id);
        if (!$foro) {
            $data = [
                'message' => 'Foro no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $foro->delete();
        $data = [
            'message' => 'Foro eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
