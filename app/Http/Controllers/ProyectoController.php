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
    public function index(Request $request)
    {
        $query = Proyecto::with(['pagos', 'user']);
        
        // Los usuarios no administradores solo ven sus propios proyectos
        if (!auth()->user()->es_admin) {
            $query->where('user_id', auth()->id());
        }
        
        $proyectos = $query->latest()->paginate(10);
        
        // Obtener lista de usuarios para el filtro (solo si es admin)
        $usuarios = collect();
        if (auth()->user()->es_admin) {
            $usuarios = User::select('id', 'name')->orderBy('name')->get();
        }
        
        return view('proyectos.index', compact('proyectos', 'usuarios'));
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

        $data = $request->all();
        
        // Si el usuario no es admin, forzar que el user_id sea el usuario actual
        if (!auth()->user()->es_admin) {
            $data['user_id'] = auth()->id();
        }

        Proyecto::create($data);

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
        // Verificar permisos: admin puede editar todos, usuarios solo los suyos
        if (!auth()->user()->es_admin && $proyecto->user_id !== auth()->id()) {
            abort(403, 'No tienes permisos para editar este proyecto.');
        }
        
        $usuarios = User::orderBy('name')->get();
        return view('proyectos.edit', compact('proyecto', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        // Verificar permisos: admin puede editar todos, usuarios solo los suyos
        if (!auth()->user()->es_admin && $proyecto->user_id !== auth()->id()) {
            abort(403, 'No tienes permisos para editar este proyecto.');
        }
        
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

        $data = $request->all();
        
        // Si el usuario no es admin, no permitir cambiar el user_id
        if (!auth()->user()->es_admin) {
            unset($data['user_id']); // Remover user_id de los datos a actualizar
        }

        $proyecto->update($data);

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        // Verificar permisos: admin puede eliminar todos, usuarios solo los suyos
        if (!auth()->user()->es_admin && $proyecto->user_id !== auth()->id()) {
            abort(403, 'No tienes permisos para eliminar este proyecto.');
        }
        
        $proyecto->delete();
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado exitosamente.');
    }
}
