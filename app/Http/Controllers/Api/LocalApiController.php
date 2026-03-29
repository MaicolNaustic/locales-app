<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocalApiController extends Controller
{
    /**
     * GET /api/locales
     * Retorna todos los locales
     */
    public function index()
    {
        $locales = Local::orderBy('nombre')->get();

        return response()->json([
            'success' => true,
            'data'    => $locales
        ]);
    }

    /**
     * PUT /api/locales/{id}
     * Actualiza un local - Este es el método crítico
     */
    public function update(Request $request, $id)
    {
        $local = Local::find($id);

        if (!$local) {
            return response()->json([
                'success' => false,
                'message' => 'Local no encontrado'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre'         => 'required|string|max:255',
            'direccion'      => 'required|string|max:500',
            'estado'         => 'required|integer|in:0,1',
            'latLong'        => 'nullable|string|max:100',
            'tipo_documento' => 'nullable|in:RUC,CEDULA',
            'nro_documento'  => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Actualizamos solo los campos permitidos
        $local->update([
            'nombre'         => $request->nombre,
            'direccion'      => $request->direccion,
            'estado'         => $request->estado,
            'latLong'        => $request->latLong,
            'tipo_documento' => $request->tipo_documento,
            'nro_documento'  => $request->nro_documento,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Local actualizado correctamente',
            'data'    => $local->fresh()
        ]);
    }
}