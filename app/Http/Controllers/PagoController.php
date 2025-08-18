<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Proyecto;
use App\Http\Requests\PagoRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Carbon\Carbon;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Pago::with(['proyecto.user']);

        // Filtro por proyecto
        if ($request->filled('proyecto_id')) {
            $query->where('proyecto_id', $request->proyecto_id);
        }

        // Filtro por método de pago
        if ($request->filled('metodo')) {
            $query->where('metodo', $request->metodo);
        }

        // Filtro por fecha específica
        if ($request->filled('fecha_pago')) {
            $query->whereDate('fecha_pago', $request->fecha_pago);
        }

        // Filtro por rango de fechas
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('fecha_pago', [$request->fecha_inicio, $request->fecha_fin]);
        }

        // Filtro por monto mínimo
        if ($request->filled('monto_min')) {
            $query->where('monto', '>=', $request->monto_min);
        }

        // Filtro por monto máximo
        if ($request->filled('monto_max')) {
            $query->where('monto', '<=', $request->monto_max);
        }

        $pagos = $query->orderBy('fecha_pago', 'desc')->paginate(10);

        // Obtener proyectos para el filtro
        $proyectos = Proyecto::orderBy('cliente')->get();

        // Obtener métodos de pago para el filtro
        $metodos = Pago::METODOS;

        // Obtener usuarios para el filtro (todos los usuarios)
        $usuarios = \App\Models\User::orderBy('name')->get();

        // Usuario autenticado
        $usuarioActual = auth()->user();

        // Estadísticas para el resumen
        $totalPagos = $query->sum('monto');
        $cantidadPagos = $query->count();

        return view('pagos.index', compact('pagos', 'proyectos', 'metodos', 'usuarios', 'usuarioActual', 'totalPagos', 'cantidadPagos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        // Obtener TODOS los proyectos con sus usuarios y pagos (sin filtros de usuario)
        // Incluir todos los estados excepto cancelado, ordenados para mostrar primero los activos
        $proyectos = Proyecto::with(['pagos', 'user'])
            ->whereNotIn('estado', ['cancelado'])
            ->orderByRaw("CASE 
                WHEN estado = 'en_progreso' THEN 1 
                WHEN estado = 'planificacion' THEN 2 
                WHEN estado = 'pausado' THEN 3 
                WHEN estado = 'completado' THEN 4 
                ELSE 5 
            END")
            ->orderBy('cliente')
            ->get()
            ->filter(function ($proyecto) {
                // Solo mostrar proyectos que tengan saldo pendiente mayor a 0
                return $proyecto->saldo_pendiente > 0;
            });

        $metodos = Pago::METODOS;

        // Si viene un proyecto_id específico, verificar que exista
        $proyectoSeleccionado = null;
        if ($request->has('proyecto_id')) {
            $proyectoSeleccionado = Proyecto::with(['pagos', 'user'])->find($request->proyecto_id);
            // Si el proyecto no está en la lista filtrada, agregarlo
            if ($proyectoSeleccionado && !$proyectos->contains('id', $proyectoSeleccionado->id)) {
                $proyectos->push($proyectoSeleccionado);
            }
        }

        return view('pagos.create', compact('proyectos', 'metodos', 'proyectoSeleccionado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PagoRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Pago::create($validated);

        return redirect()->route('pagos.index')
            ->with('success', 'Pago registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago): View
    {
        $pago->load('proyecto');
        
        return view('pagos.show', compact('pago'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago): View
    {
        // Incluir todos los proyectos activos, no solo los que tienen saldo pendiente
        // porque el pago actual podría estar cambiando de proyecto
        $proyectos = Proyecto::with('pagos')
            ->whereIn('estado', ['planificacion', 'en_progreso', 'pausado'])
            ->orderBy('cliente')
            ->get();

        $metodos = Pago::METODOS;

        return view('pagos.edit', compact('pago', 'proyectos', 'metodos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PagoRequest $request, Pago $pago): RedirectResponse
    {
        $validated = $request->validated();

        $pago->update($validated);

        return redirect()->route('pagos.index')
            ->with('success', 'Pago actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago): RedirectResponse
    {
        $pago->delete();

        return redirect()->route('pagos.index')
            ->with('success', 'Pago eliminado exitosamente.');
    }
}