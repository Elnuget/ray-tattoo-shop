<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    /**
     * Mostrar la galería general con todas las imágenes
     */
    public function index(Request $request)
    {
        $query = Imagen::with('proyecto')->ordenado();
        
        // Filtrar por tipo si se especifica
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }
        
        // Filtrar por proyecto si se especifica
        if ($request->filled('proyecto')) {
            $query->where('proyecto_id', $request->proyecto);
        }
        
        // Buscar por nombre de cliente o descripción
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('descripcion', 'like', "%{$buscar}%")
                  ->orWhere('nombre_original', 'like', "%{$buscar}%")
                  ->orWhereHas('proyecto', function($subQ) use ($buscar) {
                      $subQ->where('cliente', 'like', "%{$buscar}%");
                  });
            });
        }
        
        $imagenes = $query->paginate(24);
        $proyectos = Proyecto::orderBy('cliente')->get();
        
        return view('galeria.index', compact('imagenes', 'proyectos'));
    }
    
    /**
     * Mostrar una imagen específica en la galería
     */
    public function show(Imagen $imagen)
    {
        return view('galeria.show', compact('imagen'));
    }
}
