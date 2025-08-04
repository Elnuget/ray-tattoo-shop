<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = Proyecto::with('pagos')->latest()->paginate(10);
        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proyectos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'sesiones' => ['required', 'integer', 'min:1'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
            'estado' => ['required', 'in:pendiente,en_progreso,pausado,completado,cancelado'],
            'total' => ['required', 'numeric', 'min:0'],
            'deposito' => ['nullable', 'numeric', 'min:0', 'lte:total'],
            'precio_por_sesion' => ['nullable', 'numeric', 'min:0'],
            'ubicacion_tatuaje' => ['nullable', 'string', 'max:255'],
            'tamaño' => ['nullable', 'string', 'max:255'],
            'estilo' => ['nullable', 'string', 'max:255'],
            'notas' => ['nullable', 'string'],
        ]);

        Proyecto::create($request->all());

        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
    {
        return view('proyectos.show', compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        return view('proyectos.edit', compact('proyecto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'cliente' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'sesiones' => ['required', 'integer', 'min:1'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
            'estado' => ['required', 'in:pendiente,en_progreso,pausado,completado,cancelado'],
            'total' => ['required', 'numeric', 'min:0'],
            'deposito' => ['nullable', 'numeric', 'min:0', 'lte:total'],
            'precio_por_sesion' => ['nullable', 'numeric', 'min:0'],
            'ubicacion_tatuaje' => ['nullable', 'string', 'max:255'],
            'tamaño' => ['nullable', 'string', 'max:255'],
            'estilo' => ['nullable', 'string', 'max:255'],
            'notas' => ['nullable', 'string'],
        ]);

        $proyecto->update($request->all());

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado exitosamente.');
    }
}
