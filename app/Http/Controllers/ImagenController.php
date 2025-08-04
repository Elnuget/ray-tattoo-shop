<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImagenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Proyecto $proyecto)
    {
        $imagenes = $proyecto->imagenes()->with('proyecto')->get();
        return view('imagenes.index', compact('proyecto', 'imagenes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Proyecto $proyecto)
    {
        return view('imagenes.create', compact('proyecto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'imagenes' => ['required', 'array', 'max:10'],
            'imagenes.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'], // máximo 5MB
            'tipo' => ['required', 'in:referencia,tattoo'],
            'descripcion' => ['nullable', 'string', 'max:500'],
        ]);

        $orden = $proyecto->imagenes()->max('orden') + 1;

        foreach ($request->file('imagenes') as $archivo) {
            // Generar nombre único para el archivo
            $nombreArchivo = Str::uuid() . '.' . $archivo->getClientOriginalExtension();
            
            // Guardar en storage/app/public/proyectos/{proyecto_id}/{tipo}/
            $rutaDirectorio = "proyectos/{$proyecto->id}/{$request->tipo}";
            $rutaCompleta = $archivo->storeAs($rutaDirectorio, $nombreArchivo, 'public');

            // Crear registro en la base de datos
            Imagen::create([
                'proyecto_id' => $proyecto->id,
                'ruta' => $rutaCompleta,
                'tipo' => $request->tipo,
                'nombre_original' => $archivo->getClientOriginalName(),
                'descripcion' => $request->descripcion,
                'orden' => $orden++,
                'tamaño_archivo' => $archivo->getSize(),
                'tipo_mime' => $archivo->getMimeType(),
            ]);
        }

        return redirect()->route('proyectos.imagenes.index', $proyecto)
                         ->with('success', 'Imágenes subidas exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto, Imagen $imagen)
    {
        // Verificar que la imagen pertenece al proyecto
        if ($imagen->proyecto_id !== $proyecto->id) {
            abort(404);
        }

        return view('imagenes.show', compact('proyecto', 'imagen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto, Imagen $imagen)
    {
        // Verificar que la imagen pertenece al proyecto
        if ($imagen->proyecto_id !== $proyecto->id) {
            abort(404);
        }

        return view('imagenes.edit', compact('proyecto', 'imagen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto, Imagen $imagen)
    {
        // Verificar que la imagen pertenece al proyecto
        if ($imagen->proyecto_id !== $proyecto->id) {
            abort(404);
        }

        $request->validate([
            'tipo' => ['required', 'in:referencia,tattoo'],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        $imagen->update($request->only(['tipo', 'descripcion', 'orden']));

        return redirect()->route('proyectos.imagenes.index', $proyecto)
                         ->with('success', 'Imagen actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto, Imagen $imagen)
    {
        // Verificar que la imagen pertenece al proyecto
        if ($imagen->proyecto_id !== $proyecto->id) {
            abort(404);
        }

        $imagen->delete(); // El evento booted del modelo se encarga de eliminar el archivo físico

        return redirect()->route('proyectos.imagenes.index', $proyecto)
                         ->with('success', 'Imagen eliminada exitosamente.');
    }

    /**
     * Actualizar el orden de las imágenes
     */
    public function updateOrder(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'imagenes' => ['required', 'array'],
            'imagenes.*.id' => ['required', 'exists:imagenes,id'],
            'imagenes.*.orden' => ['required', 'integer', 'min:0'],
        ]);

        foreach ($request->imagenes as $imagenData) {
            $imagen = Imagen::find($imagenData['id']);
            if ($imagen && $imagen->proyecto_id === $proyecto->id) {
                $imagen->update(['orden' => $imagenData['orden']]);
            }
        }

        return response()->json(['success' => true]);
    }
}
