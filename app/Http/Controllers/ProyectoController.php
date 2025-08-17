<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = Proyecto::with(['pagos', 'user'])->latest()->paginate(10);
        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::orderBy('name')->get();
        return view('proyectos.create', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['nullable', 'exists:users,id'],
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
        $proyecto->load(['user', 'pagos', 'imagenes']);
        return view('proyectos.show', compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        $usuarios = User::orderBy('name')->get();
        return view('proyectos.edit', compact('proyecto', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'user_id' => ['nullable', 'exists:users,id'],
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
