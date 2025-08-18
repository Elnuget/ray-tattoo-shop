<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Obtener las imágenes de un proyecto para mostrar en modal
     */
    public function imagenesProyecto(Proyecto $proyecto)
    {
        $imagenes = $proyecto->imagenes()->ordenado()->get();
        
        return response()->json([
            'success' => true,
            'proyecto' => [
                'id' => $proyecto->id,
                'cliente' => $proyecto->cliente,
                'descripcion' => $proyecto->descripcion
            ],
            'imagenes' => $imagenes->map(function($imagen) {
                return [
                    'id' => $imagen->id,
                    'ruta' => $imagen->url,
                    'tipo' => $imagen->tipo,
                    'tipo_nombre' => $imagen->tipo_nombre,
                    'descripcion' => $imagen->descripcion,
                    'nombre_original' => $imagen->nombre_original,
                ];
            }),
            'tipos' => \App\Models\Imagen::TIPOS
        ]);
    }
}
