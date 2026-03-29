<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Local;

class LocalController extends Controller
{
    /**
     * Muestra el listado de locales consumiendo la API REST
     */
    public function index()
    {
        try {
            $response = Http::timeout(15)->get(url('/api/locales'));

            if ($response->successful()) {
                $data = $response->json();
                $locales = $data['data'] ?? $data ?? [];
                return view('locales.index', compact('locales'));
            }
        } catch (\Exception $e) {
            $locales = Local::all();
            return view('locales.index', [
                'locales' => $locales,
                'error'   => 'Modo respaldo activado'
            ]);
        }

        $locales = Local::all();
        return view('locales.index', compact('locales'));
    }

    /**
     * Muestra formulario para crear un nuevo local
     */
    public function create()
    {
        return view('locales.create');
    }

    /**
     * Guarda un nuevo local
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'direccion' => 'required|string|max:500',
            'estado'    => 'required|integer|in:0,1',
        ]);

        Local::create($request->all());

        return redirect()->route('locales.index')
            ->with('success', 'Local creado correctamente');
    }

    /**
     * Elimina un local
     */
    public function destroy(Local $local)
    {
        $local->delete();

        return redirect()->route('locales.index')
            ->with('success', 'Local eliminado correctamente');
    }
}