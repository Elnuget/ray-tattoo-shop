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
        $query = Pago::with('proyecto');

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

        // Estadísticas para el resumen
        $totalPagos = $query->sum('monto');
        $cantidadPagos = $query->count();

        return view('pagos.index', compact('pagos', 'proyectos', 'metodos', 'totalPagos', 'cantidadPagos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        // Obtener proyectos activos con saldo pendiente
        $proyectos = Proyecto::whereIn('estado', ['planificacion', 'en_progreso', 'pausado'])
            ->orderBy('cliente')
            ->get()
            ->filter(function ($proyecto) {
                return $proyecto->saldo_pendiente_actualizado > 0;
            });

        $metodos = Pago::METODOS;

        return view('pagos.create', compact('proyectos', 'metodos'));
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
        $proyectos = Proyecto::whereIn('estado', ['planificacion', 'en_progreso', 'pausado'])
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